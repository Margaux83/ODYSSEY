<?php

namespace App\Core;

class Database
{
    protected $pdo;
    protected $table;

    public function __construct($class = null)
    {
        try {
            $this->pdo = new \PDO(DBDRIVER . ":dbname=" . DBNAME . ";host=" . DBHOST, DBUSER, DBPWD);

            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        } catch (Exception $e) {
            die ("Erreur SQL " . $e->getMessage());
        }

        //echo get_called_class(); //  App\Models\User ici on peut récupérer le nom de la table
        $classExploded = $class !== null ? $class : explode("\\", get_called_class());
        $this->table = DBPREFIX . ($class !== null ? $class : end($classExploded));

    }

    public function getParentFields()
    {
        return array_keys(get_class_vars(__CLASS__));
    }

    public function query($requestedParams = [], $filter = [], $filterString = '', $moreString = '')
    {
        $columnFilter = [];
        foreach ($filter as $key => $value) {
            if (!is_null($value)) {
                if($key[0] !== "!") {
                    $columnFilter[] = $key . "=:" . $key;
                } else {
                    $columnFilter[] = ltrim($key, $key[0]) . "!=:" . ltrim($key, $key[0]);
                }
                // $columnFilter[] = $key . "=:" . substr($key, strpos($key, '.') + 1);
            }
        }
        $sql = "SELECT " . implode(",", $requestedParams) . " FROM " . $this->table
            . ($moreString ? $moreString : '')
            . (count($filter) ? " WHERE " . implode(" AND ", $columnFilter) : '')
            . ($filterString ? (count($filter) ? " AND " : ' WHERE ') . $filterString : '');

        $query = $this->pdo->prepare($sql);
        foreach ($filter as $key => $value) {
            if (!is_null($value)) {
                if($key[0] !== "!") {
                    $query->bindValue(":".$key, $value);
                } else {
                    $query->bindValue(":".ltrim($key, $key[0]), $value);
                }
            }
        }
        $query->execute();

        return $query->fetchAll();
    }

    public function get_foreignKeys()
    {
        return [];
    }

    public function save()
    {
        $data = array_diff_key(
            get_object_vars($this),
            get_class_vars(get_class())
        );

        foreach ($data as $key => $value) {
            if (is_string($value)) {
                if ($key === 'updateDate') {
                    $updateDate = new \DateTime();
                    $data[$key] = $updateDate->format('Y-m-d H:i:s');
                }else {
                    $data[$key] = addslashes($value);
                }
            }
        }

        $data = array_filter($data, function($value, $key) {
            if (!in_array($key, $this->get_foreignKeys())) {
                return [$key => $value];
            }
        }, ARRAY_FILTER_USE_BOTH);

        $columnForUpdate = [];

        if (is_null($this->getId())) {
            //INSERT
            $query = $this->pdo->prepare("INSERT INTO " . $this->table . " (
                                            " . implode(",", $columns) . "
                                            ) VALUES (
                                            :" . implode(",:", $columns) . "
                                            )");
            $query->execute($data);
        } else {
            foreach ($data as $key => $value) {
                if (!is_null($value)) {
                    $columnForUpdate[] = $key . "=:" . $key;
                }
            }

            $sql = "UPDATE " . $this->table . " SET " . implode(",", $columnForUpdate) . " WHERE id=" . $this->getId();
            $query = $this->pdo->prepare($sql);

            foreach ($data as $key => $value) {
                if (!is_null($value)) {
                    $query->bindValue(":$key", $value);
                }

            }
           $query->execute();
        }
    }

    public function createDatabase($query) {
        if(!empty($query)) {
            $query = $this->pdo->exec($query);
            return true;
        }
        return false;
    }

    //On sélectionne l'id de la dernière entrée
    public function getLastFromTable()
    {
        $selectLastId="SELECT id FROM " . $this->table . " ORDER BY id DESC LIMIT 1 ";
        $querySelect = $this->pdo->prepare($selectLastId);
        $querySelect->execute();
        return $querySelect->fetchAll();
    }

    public function delete($id)
    {
        $query = $this->pdo->prepare("UPDATE " . $this->table . " SET isDeleted=1 WHERE id=" . $id);
        $query->execute();
    }

    public function verify($id)
    {
        $query = $this->pdo->prepare("UPDATE " . $this->table . " SET isVerified=1 WHERE id=" . $id);
        $query->execute();
    }

    public function updateWithData($data = [])
    {
        foreach ($data as $key => $value) {
            $setAction = 'set' . ucfirst(trim($key));
            $this->$setAction($value);
        }
    }
}

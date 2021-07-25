<?php

namespace App\Core;

class Database
{
    protected $pdo;
    protected $table;

    /**
     * Database constructor.
     * @param null $class
     * Login to the database
     */
    public function __construct($class = null)
    {
        try {
            $this->pdo = new \PDO(DBDRIVER . ":dbname=" . DBNAME . ";host=" . DBHOST, DBUSER, DBPWD);

            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        } catch (Exception $e) {
            die ("Erreur SQL " . $e->getMessage());
        }

        $classExploded = $class !== null ? $class : explode("\\", get_called_class());
        $this->table = DBPREFIX . ($class !== null ? $class : end($classExploded));

    }

    public function getParentFields()
    {
        return array_keys(get_class_vars(__CLASS__));
    }

    /**
     * @param array $requestedParams
     * @param array $filter
     * @param string $filterString
     * @param string $moreString
     * @return array
     * Function to create a SELECT request, $resuestedParams contains the columns that we want to return and the condition filters
     */
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

    /**
     * @return array
     * Function to return de foreign key, used to save values in tables that contains foreign keys
     */
    public function get_foreignKeys()
    {
        return [];
    }

    /**
     * Function to save information in the database, if an id exist, we execute an UPDATE request, if not we execute an INSERT INTO request
     */
    public function save()
    {
        $data = array_diff_key(

            get_object_vars($this),

            get_class_vars(get_class())

        );

        $data = array_filter($data, function($value, $key) {
            if (!in_array($key, $this->get_foreignKeys())) {
                return [$key => $value];
            }
        }, ARRAY_FILTER_USE_BOTH);

        $columns = array_keys($data);
        $values = array_values($data);

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

    /**
     * @param $query
     * @return bool
     * Function to create the database
     */
    public function createDatabase($query) {
        if(!empty($query)) {
            $query = $this->pdo->exec($query);
            return true;
        }
        return false;
    }

    /**
     * @return array
     * Select the id of the last entry
     */
    public function getLastFromTable()
    {
        $selectLastId="SELECT id FROM " . $this->table . " ORDER BY id DESC LIMIT 1 ";
        $querySelect = $this->pdo->prepare($selectLastId);
        $querySelect->execute();
        return $querySelect->fetchAll();
    }

    /**
     * @param $id
     * Function to "delete" an item, we set the isDeleted column to 1
     */
    public function delete($id)
    {
        $query = $this->pdo->prepare("UPDATE " . $this->table . " SET isDeleted=1 WHERE id=" . $id);
        $query->execute();
    }

    /**
     * @param $id
     * Function to verify an item (user or comment), we set the isVerified column to 1
     */
    public function verify($id)
    {
        $query = $this->pdo->prepare("UPDATE " . $this->table . " SET isVerified=1 WHERE id=" . $id);
        $query->execute();
    }

    /**
     * @param array $data
     * Function to update the data of an item
     */
    public function updateWithData($data = [])
    {
        foreach ($data as $key => $value) {
            $setAction = 'set' . ucfirst(trim($key));
            $this->$setAction($value);
        }
    }
}

<?php

namespace App\Core;

class Database
{

    protected $pdo;
    protected $table;

    public function __construct($class = null)
    {
        try {
            $this->pdo = new \PDO(DBDRIVER . ":dbname=" . DBNAME . ";host=" . DBHOST . ";port=" . DBPORT, DBUSER, DBPWD);

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

    public function query($requestedParams = [], $filter = [])
    {
        $columnFilter = [];
        foreach ($filter as $key => $value) {
            if (!is_null($value)) {
                $columnFilter[] = $key . "=:" . $key;
            }
        }

        $sql = "SELECT " . implode(",", $requestedParams) . " FROM " . $this->table . " WHERE " . implode(" AND ", $columnFilter);
        $query = $this->pdo->prepare($sql);
        foreach ($filter as $key => $value) {
            if (!is_null($value)) {
                $query->bindValue(":$key", $value);
            }
        }
        $query->execute();

        return $query->fetchAll();
    }

    public function save()
    {
        $data = array_diff_key(

            get_object_vars($this),

            get_class_vars(get_class())

        );

        $columns = array_keys($data);
        $values = array_values($data);

        $columnForUpdate = [];

        if(is_null($this->getId())){
            //INSERT
            $columns = array_keys($data);
            $query = $this->pdo->prepare("INSERT INTO ".$this->table." (
                                            ".implode(",", $columns)."
                                            ) VALUES (
                                            :".implode(",:", $columns)."
                                            )");

        }else{
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
           // $query->execute();
        }
    }



}
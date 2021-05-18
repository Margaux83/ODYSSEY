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
            $query->execute($data);

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
            $query->execute();
        }
    }

    //Ajout d'un article dans la base de données
    public function saveArticle()
    {

        $data = array_diff_key(

            get_object_vars($this),

            get_class_vars(get_class())

        );
        unset($data["category"]);

        $columns = array_keys($data);
        $values = array_values($data);
        //INSERT
        if(is_null($this->getId())){
            $columns = array_keys($data);
            $query = $this->pdo->prepare("INSERT INTO ".$this->table." (
                                            ".implode(",", $columns)."
                                            ) VALUES (
                                            :".implode(",:", $columns)."
                                            )");
            $query->execute($data);

            $success = "<div class=\"success\">L'article a bien été ajouté</div>";
        }
        else{
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

        //On sélectionne l'id du dernier article
        $selectLastId="SELECT id FROM " . $this->table ." ORDER BY id DESC LIMIT 1 ";
        $querySelect = $this->pdo->prepare($selectLastId);
        $querySelect->execute();
        return $querySelect->fetchAll();
    }

    public function saveArticleCategory($category,$id_Article)
    {
        $sql = $this->pdo->prepare("INSERT INTO ody_Category_Article (id_Category,id_Article) VALUES (".$category.",".$id_Article." )");
        $sql->execute();
    }


    public function getAllArticles()
    {

        $sql = "SELECT ody_Article.id, ody_Article.title, ody_Article.content, ody_Article.description, ody_Article.status, ody_Article.isVisible, ody_Article.isDraft,
                    ody_Article.isDeleted, ody_Article.creationDate, ody_Article.updateDate, ody_Article.id_User, ody_User.firstname, ody_User.lastname, ody_User.role  FROM " . $this->table . " INNER JOIN ody_User ON ". $this->table.".id_User = ody_User.ID WHERE ody_Article.isDeleted=0";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll();

    }

    public function getArticleByUser($id)
    {
        $sql ="SELECT ody_Article.id, ody_Article.title, ody_Article.content, ody_Article.description, ody_Article.status, ody_Article.isVisible, ody_Article.isDraft,
                    ody_Article.isDeleted, ody_Article.creationDate, ody_Article.updateDate, ody_Article.id_User, ody_User.firstname, ody_User.lastname, ody_User.role  FROM " . $this->table . " INNER JOIN ody_User ON ". $this->table.".id_User = ody_User.ID WHERE ody_Article.isDeleted=0 AND id_User=".$id;
        $query = $this->pdo->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function delete($id)
    {
        $sql ="UPDATE ". $this->table ." SET isDeleted=1 WHERE id=".$id;
        $query = $this->pdo->prepare($sql);
        $query->execute();

    }
}
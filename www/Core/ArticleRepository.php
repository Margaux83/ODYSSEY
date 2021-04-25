<?php


namespace App\Core;
use App\Core\Database;
use function Couchbase\defaultDecoder;

class ArticleRepository extends Database
{
    public function saveArticle()
    {

        $data = array_diff_key(

            get_object_vars($this),

            get_class_vars(get_class())

        );

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
    }

    public function getAllArticles()
    {

        $sql = "SELECT * FROM " . $this->table . " INNER JOIN ody_User ON ". $this->table.".id_User = ody_User.ID";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        //var_dump($query);
        //die();
        return $query->fetchAll();

    }
}
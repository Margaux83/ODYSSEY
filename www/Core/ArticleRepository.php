<?php


namespace App\Core;
use App\Core\Database;

class ArticleRepository extends Database
{
    public function saveArticle()
    {
        var_dump($_POST);

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
}
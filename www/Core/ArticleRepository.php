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
    }

    public function getAllArticles()
    {

        $sql = "SELECT ody_Article.id, ody_Article.title, ody_Article.content, ody_Article.description, ody_Article.status, ody_Article.isVisible, ody_Article.isDraft,
                    ody_Article.isDeleted, ody_Article.creationDate, ody_Article.updateDate, ody_Article.id_User, ody_User.firstname, ody_User.lastname, ody_User.role  FROM " . $this->table . " INNER JOIN ody_User ON ". $this->table.".id_User = ody_User.ID";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        //var_dump($query);
        //die();
        return $query->fetchAll();

    }

    public function deleteArticle($id)
    {
        $sql ="DELETE * FROM ". $this->table ." WHERE id=".$id;
        $query = $this->pdo->prepare($sql);
        $query->execute();
    }

    public function getArticleByUser($id)
    {
        $sql ="SELECT ody_Article.id, ody_Article.title, ody_Article.content, ody_Article.description, ody_Article.status, ody_Article.isVisible, ody_Article.isDraft,
                    ody_Article.isDeleted, ody_Article.creationDate, ody_Article.updateDate, ody_Article.id_User, ody_User.firstname, ody_User.lastname, ody_User.role  FROM " . $this->table . " INNER JOIN ody_User ON ". $this->table.".id_User = ody_User.ID WHERE id_User=".$id;
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}
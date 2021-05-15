<?php


namespace App\Core;
use App\Core\Database;
use function Couchbase\defaultDecoder;

class ArticleRepository extends Database
{
    public function __construct()
    {
        parent::__construct();
    }




    public function delete($id)
    {
        $sql ="UPDATE ". $this->table ." SET isDeleted=1 WHERE id=".$id;
        $query = $this->pdo->prepare($sql);
        $query->execute();

    }

}
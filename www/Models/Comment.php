<?php


namespace App\Models;

use App\Core\Database;


class Comment extends Database
{
    protected $id=null;
    protected $content;
    protected $id_article;
    protected $isdeleted;
    protected $id_user;
    protected $id_comment;

    /**
     * @param $id
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param $isdeleted
     */
    public function setIsdeleted($isdeleted)
    {
        $this->isdeleted = $isdeleted;
    }

    /**
     * @return mixed
     */
    public function getIsdeleted()
    {
        return $this->isdeleted;
    }

    /**
     * @param $id_article
     */
    public function setId_article($id_article)
    {
        $this->id_article = $id_article;
    }

    public function getId_article()
    {
        return $this->id_article;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_comment
     */
    public function setIdComment($id_comment)
    {
        $this->id_comment = $id_comment;
    }

    /**
     * @return mixed
     */
    public function getIdComment()
    {
        return $this->id_comment;
    }
}
<?php


namespace App\Models;


class Comment
{
    protected $id=null;
    protected $title;
    protected $content;
    protected $firstname;
    protected $lastname;
    protected $id_article;
    protected $email;
    protected $isdeleted;

    public function setId($id){
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
       $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setId_article($id_article)
    {
        $this->id_article = $id_article;
    }

    public function getId_article()
    {
        return $this->id_article;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setIsdeleted($isdeleted)
    {
        $this->isdeleted = $isdeleted;
    }

    public function getIsdeleted()
    {
        return $this->isdeleted;
    }
}
<?php


namespace App\Models;

use App\Core\Database;

class Article extends Database
{

    private $id;
    protected $title;
    protected $content;
    protected $status;
    protected $visibility;
    protected $isdraft;
    protected $description;
    protected $isdeleted;
    protected $id_category;
    protected $id_article_page;
    protected $id_user;

    public function __construct(){
        parent::__construct();
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public function getID()
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

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }

    public function getVisibility()
    {
        return $this->visibility;
    }

    public function setIsdraft($isdraft)
    {
        $this->isdraft = $isdraft;
    }

    public function getIsdraft()
    {
        return $this->isdraft;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setIsdeleted($isdeleted)
    {
        $this->isdeleted = $isdeleted;
    }

    public function getIsdeleted()
    {
        return $this->isdeleted;
    }

    public function setId_category($category)
    {
        $this->id_category = $category;
    }

    public function getId_category()
    {
        return $this->id_category;
    }

    public function setId_article_page($id_article_page)
    {
        $this->id_article_page = $id_article_page;
    }

    public function getId_article_page()
    {
        return $this->id_article_page;
    }

    public function setId_user($id_user)
    {
        $this->id_user = $id_user;
    }

    public function getId_user()
    {
        return $this->id_user;
    }
}
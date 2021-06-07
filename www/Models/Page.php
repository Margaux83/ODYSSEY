<?php
namespace App\Models;

use App\Core\Database;

class Page extends Database
{
    private $id=null;
    protected $uri;
    protected $title;
    protected $content;
    protected $description;
    protected $isDraft;
    protected $status;

    /**
     * User constructor.
     */
    public function __construct(){
        parent::__construct();
    }

    public function getUri(){
        return $this->uri;
    }
    public function setUri($uri){
        $this->uri = $uri;
    }

    public function getTitle(){
        return $this->title;
    }
    public function setTitle($title){
        $this->title = $title;
    }

    public function getContent(){
        return $this->content;
    }
    public function setContent($content){
        $this->content = $content;
    }

    public function getDescription(){
        return $this->description;
    }
    public function setDescription($description){
        $this->description = $description;
    }

    public function getIsDraft(){
        return $this->isDraft;
    }
    public function setIsDraft($isDraft){
        $this->isDraft = $isDraft;
    }

    public function getStatus(){
        return $this->status;
    }
    public function setStatus($status){
        $this->status = $status;
    }
}
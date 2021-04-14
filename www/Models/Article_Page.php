<?php


namespace App\Models;


class Article_Page
{
    protected $id=null;
    protected $id_article;
    protected $id_page;

    /**
     * @param null $id
     */
    public function setId($id)
    {
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
     * @param mixed $id_article
     */
    public function setIdArticle($id_article)
    {
        $this->id_article = $id_article;
    }

    /**
     * @return mixed
     */
    public function getIdArticle()
    {
        return $this->id_article;
    }

    /**
     * @param mixed $id_page
     */
    public function setIdPage($id_page)
    {
        $this->id_page = $id_page;
    }

    /**
     * @return mixed
     */
    public function getIdPage()
    {
        return $this->id_page;
    }
}
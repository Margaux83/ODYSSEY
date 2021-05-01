<?php


namespace App\Models;


class CategoryArticle
{
    protected $id;
    protected $id_category;
    protected $id_article;

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id_category
     */
    public function setIdCategory($id_category)
    {
        $this->id_category = $id_category;
    }

    /**
     * @return mixed
     */
    public function getIdCategory()
    {
        return $this->id_category;
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
}
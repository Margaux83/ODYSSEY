<?php


namespace App\Models;


class CategoryPage
{
    protected $id;
    protected $id_category;
    protected $id_page;

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

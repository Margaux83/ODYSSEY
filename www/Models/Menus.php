<?php


namespace App\Models;


class Menus
{
    protected $id;
    protected $name;
    protected $creationDate;
    protected $editDate;
    protected $order;
    protected $primaryMenu;
    protected $secondaryMenu;
    protected $isdeleted;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return mixed
     */
    public function getEditDate()
    {
        return $this->editDate;
    }

    /**
     * @param mixed $editDate
     */
    public function setEditDate($editDate)
    {
        $this->editDate = $editDate;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getPrimaryMenu()
    {
        return $this->primaryMenu;
    }

    /**
     * @param mixed $primaryMenu
     */
    public function setPrimaryMenu($primaryMenu)
    {
        $this->primaryMenu = $primaryMenu;
    }

    /**
     * @return mixed
     */
    public function getSecondaryMenu()
    {
        return $this->secondaryMenu;
    }

    /**
     * @param mixed $secondaryMenu
     */
    public function setSecondaryMenu($secondaryMenu)
    {
        $this->secondaryMenu = $secondaryMenu;
    }

    /**
     * @param mixed $isdeleted
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
}
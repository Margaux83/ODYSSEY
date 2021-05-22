<?php


namespace App\Models;


class Reservations
{
    protected $id;
    protected $status;
    protected $id_user;
    protected $id_voyage;

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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getId_voyage()
    {
        return $this->id_voyage;
    }

    /**
     * @param mixed $id_voyage
     */
    public function setId_voyage($id_voyage)
    {
        $this->id_voyage = $id_voyage;
    }

}
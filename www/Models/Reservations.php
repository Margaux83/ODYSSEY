<?php


namespace App\Models;


class Reservations
{
    protected $id;
    protected $iscanceled;
    protected $reservationdate;
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
    public function getIscanceled()
    {
        return $this->iscanceled;
    }

    /**
     * @param mixed $iscanceled
     */
    public function setIscanceled($iscanceled)
    {
        $this->iscanceled = $iscanceled;
    }

    /**
     * @return mixed
     */
    public function getReservationdate()
    {
        return $this->reservationdate;
    }

    /**
     * @param mixed $reservationdate
     */
    public function setReservationdate($reservationdate)
    {
        $this->reservationdate = $reservationdate;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
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
    public function getIdVoyage()
    {
        return $this->id_voyage;
    }

    /**
     * @param mixed $id_voyage
     */
    public function setIdVoyage($id_voyage)
    {
        $this->id_voyage = $id_voyage;
    }

}
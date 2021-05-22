<?php


namespace App\Models;


class Voyage
{
    protected $id;
    protected $arrival;
    protected $departure;
    protected $arrivaldate;
    protected $departuredate;
    protected $status;
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
    public function getArrival()
    {
        return $this->arrival;
    }

    /**
     * @param mixed $arrival
     */
    public function setArrival($arrival)
    {
        $this->arrival = $arrival;
    }

    /**
     * @return mixed
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * @param mixed $departure
     */
    public function setDeparture($departure)
    {
        $this->departure = $departure;
    }

    /**
     * @return mixed
     */
    public function getArrivaldate()
    {
        return $this->arrivaldate;
    }

    /**
     * @param mixed $arrivaldate
     */
    public function setArrivaldate($arrivaldate)
    {
        $this->arrivaldate = $arrivaldate;
    }

    /**
     * @return mixed
     */
    public function getDeparturedate()
    {
        return $this->departuredate;
    }

    /**
     * @param mixed $departuredate
     */
    public function setDeparturedate($departuredate)
    {
        $this->departuredate = $departuredate;
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
    public function getIsdeleted()
    {
        return $this->isdeleted;
    }

    /**
     * @param mixed $isdeleted
     */
    public function setIsdeleted($isdeleted)
    {
        $this->isdeleted = $isdeleted;
    }

}
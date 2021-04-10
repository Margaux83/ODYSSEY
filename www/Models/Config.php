<?php


namespace App\Models;


class Config
{
    protected $id=null;
    protected $database_name;
    protected $website_name;
    protected $url_name;
    protected $langue;
    protected $timezone;
    protected $server_name;
    protected $port;

    /**
     * @param $id
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
     * @param $database_name
     */
    public function setDatabase_name($database_name)
    {
        $this->database_name = $database_name;
    }

    /**
     * @return mixed
     */
    public function getDatabase_name()
    {
        return $this->database_name;
    }


    /**
     * @param $website_name
     */
    public function setWebsite_name($website_name)
    {
        $this->website_name = $website_name;
    }

    /**
     * @return mixed
     */
    public function getWebsite_name()
    {
       return $this->website_name;
    }

    /**
     * @param $url_name
     */
    public function setUrl_name($url_name)
    {
        $this->url_name = $url_name;
    }

    /**
     * @return mixed
     */
    public function getUrl_name()
    {
        return $this->url_name;
    }

    /**
     * @param mixed $langue
     */
    public function setLangue($langue)
    {
        $this->langue = $langue;
    }

    /**
     * @return mixed
     */
    public function getLangue()
    {
        return $this->langue;
    }

    /**
     * @param mixed $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * @return mixed
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param mixed $server_name
     */
    public function setServerName($server_name)
    {
        $this->server_name = $server_name;
    }

    /**
     * @return mixed
     */
    public function getServerName()
    {
        return $this->server_name;
    }

    /**
     * @param mixed $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }
}
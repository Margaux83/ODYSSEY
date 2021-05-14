<?php


namespace App\Models;


class Settings
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

    public function buildFormConfig($result)
    {
        return [

            "config"=>[
                "method"=>"POST",
                "Action"=>"",
                "Submit"=>"Enregistrer",
                "class"=>"form-group",
            ],
            "input"=>[
                "bdd"=>[
                    "type"=>"text",
                    "label"=>"Nom de la base de données",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "class"=>"form-input",
                    "value"=>"{$result[0][1]}",
                    "error"=>"Le nom de la bdd doit faire entre 2 et 255 caractères"
                ],
                "site"=>[
                    "type"=>"text",
                    "label"=>"Nom du site",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "class"=>"form-input",
                    "value"=>"{$result[1][1]}",
                    "error"=>"Le titre du nom du site doit faire entre 2 et 255 caractères"
                ],
                "url"=>[
                    "type"=>"text",
                    "label"=>"URL du site",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "class"=>"form-input",
                    "value"=>"{$result[2][1]}",
                    "error"=>"L'url du site doit faire entre 2 et 255 caractères"
                ],
                "langue"=>[
                    "type"=>"select",
                    "label"=>"Langue du site",
                    "required"=>true,
                    "error"=>"Veuillez sélectionner un élément",
                    "placeholder"=>"Choisir une langue",
                    "class"=>"form-input",
                    "options"=>[
                        "1"=>[
                            "label" => "Français (fr_FR)",
                            "selected" => true
                        ],
                        "2"=>[
                            "label" => "Anglais (en_EN)",
                            "selected" => false
                        ]
                    ],
                ],
                "fuseau"=>[
                    "type"=>"select",
                    "label"=>"Fuseau horaire",
                    "required"=>true,
                    "error"=>"Veuillez sélectionner un élément",
                    "placeholder"=>"Choisir un fuseau horaire",
                    "class"=>"form-input",
                    "options"=>[
                        "1"=>[
                            "label" => "(UTC+01:00) Paris",
                            "selected" => false
                        ],
                        "2"=>[
                            "label" => "(UTC+02:00) Berlin",
                            "selected" => true
                        ],
                        "3"=>[
                            "label" => "(UTC+03:00) Moscou",
                            "selected" => false
                        ]
                    ],
                ],
                "adresse_serveur"=>[
                    "type"=>"text",
                    "label"=>"Adresse serveur",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "class"=>"form-input",
                    "value"=>"{$result[5][1]}",
                    "error"=>"Le titre de l'adresse web ODYSSEY doit faire entre 2 et 255 caractères"
                ],
                "port"=>[
                    "type"=>"text",
                    "label"=>"Port",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "class"=>"form-input",
                    "value"=>"{$result[6][1]}",
                    "error"=>"Le port du site doit faire entre 2 et 255 caractères"
                ]
            ],


        ];
    }
}
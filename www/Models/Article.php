<?php


namespace App\Models;

use App\Core\ArticleRepository;
use App\Core\Database;

class Article extends ArticleRepository
{

    private $id;
    protected $title;
    protected $content;
    protected $status;
    protected $isvisible;
    protected $category;
    protected $isdraft;
    protected $description;
    protected $isdeleted;
    protected $id_user;

    public function __construct(){
        parent::__construct();
    }

    /**
     * @param $id
     */
    public function setID($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $isvisible
     */
    public function setIsvisible($isvisible)
    {
        $this->isvisible = $isvisible;
    }

    /**
     * @return mixed
     */
    public function getIsvisible()
    {
        return $this->isvisible;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param $isdraft
     */
    public function setIsdraft($isdraft)
    {
        $this->isdraft = $isdraft;
    }

    /**
     * @return mixed
     */
    public function getIsdraft()
    {
        return $this->isdraft;
    }

    /**
     * @param $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $isdeleted
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

    /**
     * @param $id_user
     */
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getId_user()
    {
        return $this->id_user;
    }

    public function buildFormArticle()
    {
        return [

            "config"=>[
                "method"=>"POST",
                "Action"=>"",
                "Submit"=>"Publier",
                "class"=>"",
            ],
                "input"=>[
                    "title"=>[
                        "type"=>"text",
                        "label"=>"Veuillez choisir un titre pour votre article",
                        "lengthMax"=>"255",
                        "lengthMin"=>"2",
                        "required"=>true,
                        "class"=>"input",
                        "error"=>"Le titre de l'article doit faire entre 2 et 255 caractères",
                    ],
                    "content"=>[
                        "type"=>"textarea",
                        "class"=>"trumbowygTextarea",
                        "id"=>"content",
                        "label"=>"",
                        "required"=>true,
                    ],

                    "category"=>[
                        "type"=>"select",
                        "label"=>"Catégorie",
                        "required"=>true,
                        "error"=>"Veuillez sélectionner un élément",
                        "placeholder"=>"Choisir une catégorie",
                        "options"=>[
                            "1"=>[
                                "label" => "Voyage",
                            ],
                            "2"=>[
                                "label" => "Nature",
                            ],
                            "3"=>[
                                "label" => "Culture"
                            ],
                            "4"=>[
                                "label" => "Pays"
                            ]
                        ],

                    ],
                    "status"=>[
                        "type"=>"select",
                        "label"=>"Statut",
                        "required"=>true,
                        "error"=>"Veuillez sélectionner un élément",
                        "placeholder"=>"Choisir un statut",
                        "options"=>[
                            "1"=>[
                                "label" => "Validé et posté",
                            ],
                            "2"=>[
                                "label" => "En attente de validation",
                            ],
                            "3"=>[
                                "label" => "Brouillon"
                            ],
                            "4"=>[
                                "label" => "Créé"
                            ]
                        ]
                    ],
                    "isvisible"=>[
                        "type"=>"select",
                        "label"=>"Visibilité",
                        "required"=>true,
                        "error"=>"Veuillez sélectionner un élément",
                        "placeholder"=>"Choisir une visibilité",
                        "options"=>[
                            "1"=>[
                                "label" => "Protégé",
                            ],
                            "2"=>[
                                "label" => "Public",
                            ],
                            "3"=>[
                                "label" => "Privé"
                            ]
                        ]
                    ]

                ]

        ];
    }
}
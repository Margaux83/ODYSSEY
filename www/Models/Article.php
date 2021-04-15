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
    protected $visibility;
    protected $isdraft;
    protected $description;
    protected $isdeleted;
    protected $id_category;
    protected $id_article_page;
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
     * @param $visibility
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }

    /**
     * @return mixed
     */
    public function getVisibility()
    {
        return $this->visibility;
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
     * @param $category
     */
    public function setId_category($category)
    {
        $this->id_category = $category;
    }

    /**
     * @return mixed
     */
    public function getId_category()
    {
        return $this->id_category;
    }

    /**
     * @param $id_article_page
     */
    public function setId_article_page($id_article_page)
    {
        $this->id_article_page = $id_article_page;
    }

    /**
     * @return mixed
     */
    public function getId_article_page()
    {
        return $this->id_article_page;
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
                        "label"=>"Titre",
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
                            "Voyage"=>[
                                "label" => "Voyage",
                            ],
                            "Nature"=>[
                                "label" => "Nature",
                            ],
                            "Culture"=>[
                                "label" => "Culture"
                            ],
                            "Pays"=>[
                                "label" => "Pays"
                            ]
                        ],

                    ],
                    "page"=>[
                        "type"=>"select",
                        "label"=>"Page",
                        "required"=>true,
                        "error"=>"Veuillez sélectionner un élément",
                        "placeholder"=>"Choisir une page",
                        "options"=>[
                            "Accueil"=>[
                                "label" => "Accueil",
                            ],
                            "Voyages"=>[
                                "label" => "Voyages",
                            ],
                            "Réservations"=>[
                                "label" => "Réservations"
                            ],
                            "Contact"=>[
                                "label" => "Contact"
                            ]
                        ],

                    ],
                    "publication"=>[
                        "type"=>"select",
                        "label"=>"Publication",
                        "required"=>true,
                        "error"=>"Veuillez sélectionner un élément",
                        "placeholder"=>"Choisir une publication",
                        "options"=>[
                            "Tout de suite"=>[
                                "label" => "Tout de suite",
                            ],
                            "Dans 5 minutes"=>[
                                "label" => "Dans 5 minutes",
                            ],
                            "Dans 30 minutes"=>[
                                "label" => "Dans 30 minutes"
                            ],
                            "Dans 1 heure"=>[
                                "label" => "Dans 1 heure"
                            ]
                        ]
                        ],
                    "status"=>[
                        "type"=>"select",
                        "label"=>"Statut",
                        "required"=>true,
                        "error"=>"Veuillez sélectionner un élément",
                        "placeholder"=>"Choisir un statut",
                        "options"=>[
                            "Validé et posté"=>[
                                "label" => "Tout de suite",
                            ],
                            "En attente de validation"=>[
                                "label" => "Dans 5 minutes",
                            ],
                            "Brouillon"=>[
                                "label" => "Dans 30 minutes"
                            ],
                            "Créé"=>[
                                "label" => "Créé"
                            ]
                        ]
                    ],

                    ]

        ];
    }
}
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

    public function setID($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }

    public function getVisibility()
    {
        return $this->visibility;
    }

    public function setIsdraft($isdraft)
    {
        $this->isdraft = $isdraft;
    }

    public function getIsdraft()
    {
        return $this->isdraft;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setIsdeleted($isdeleted)
    {
        $this->isdeleted = $isdeleted;
    }

    public function getIsdeleted()
    {
        return $this->isdeleted;
    }

    public function setId_category($category)
    {
        $this->id_category = $category;
    }

    public function getId_category()
    {
        return $this->id_category;
    }

    public function setId_article_page($id_article_page)
    {
        $this->id_article_page = $id_article_page;
    }

    public function getId_article_page()
    {
        return $this->id_article_page;
    }

    public function setId_user($id_user)
    {
        $this->id_user = $id_user;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

   /* public function buildFormSearchArticle()
    {
        return [

            "config"=>[
                "method"=>"POST",
                "Action"=>"",
                "Submit"=>"Rechercher",
                "class"=>"d-flex d-flex-wrap"
            ],
                "input"=>[
                    "title"=>[
                        "type"=>"text",
                        "label"=>"Titre",
                        "lengthMax"=>"255",
                        "lengthMin"=>"2",
                        "required"=>true,
                        "error"=>"Le titre de l'article doit faire entre 2 et 255 caractères",
                    ],
                    "creator"=>[
                        "type"=>"text",
                        "label"=>"Créateur",
                        "lengthMax"=>"255",
                        "lengthMin"=>"2",
                        "required"=>true,
                        "error"=>"Votre nom doit faire entre 2 et 255 caractères",
                        "placeholder"=>"Votre nom"
                    ],
                    "dateCreation"=>[
                        "type"=>"date",
                        "label"=>"Date de création",
                        "required"=>true,
                        "dateMax"=>"".date('Y-m-d')."",
                        "dateMin"=>"1920-01-01",
                        "placeholder"=>"Votre email"
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
                    ]
                    ]

        ];
    }*/
}
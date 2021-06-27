<?php
namespace App\Models;

use App\Core\Database;

class Role extends Database
{
    private $id = null;
    protected $name;
    protected $value;

    /**
     * User constructor.
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * @param $id
     */
    public function setId($id){
        $this->id = $id;
        //Il va chercher en BDD toutes les informations de l'utilisateur
        $data = array_diff_key(
            get_object_vars($this),
            get_class_vars(get_parent_class())
        );
        $columns = array_keys($data);

        $statement = $this->pdo->prepare("SELECT " . implode(',', $columns) . " FROM ".$this->table." WHERE id=:id");
        $statement->execute(array(":id" => $this->getId()));
        $obj = $statement->fetchObject(__CLASS__);

        $this->setUserFromObj($obj);
    }

    private function setUserFromObj($obj){
        $data = array_diff_key(
            get_object_vars($this),
            get_class_vars(get_parent_class())
        );
        $columns = array_keys($data);

        foreach ($columns as $key => $value) {
            $getAction = 'get' . ucfirst(trim($value));
            $objReturnedValue = $obj->$getAction();
            if (!empty($objReturnedValue)){
                $setAction = 'set' . ucfirst(trim($value));
                if ($setAction !== 'setId'){
                    $this->$setAction($objReturnedValue);
                }
            }
        }
    }

    /**
     * @return |null
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @param $name
     */
    public function setName($name){
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $value
     */
    public function setValue($value){
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function getAllRoles()
    {
        $db = new Database("Role");
        return $result = $db->query(
            ["id" ,"name"]
        );
    }

    public function rolesList()
    {
        return [
            "all" => [
                "values" => [
                    "all_perms" => [
                        "desc" => "Donner tous les droits"
                    ]
                ]
            ],
            "basics" => [
                "title" => "Permissions générales",
                "values" => [
                    "access_admin" => [
                        "desc" => "Acceder au panel admin"
                    ]
                ]
            ],
            "users" => [
                "title" => "Gestion des utilisateurs",
                "values" => [
                    "user_add" => [
                        "desc" => "Ajouter un utilisateur"
                    ],
                    "user_edit" => [
                        "desc" => "Modifier un utilisateur"
                    ],
                    "user_del" => [
                        "desc" => "Supprimer un utilisateur"
                    ]

                ]
            ],
            'pages' => [
                'title' => 'Gestion des pages',
                'values' => [
                    "page_view" => [
                        "desc" => "Voir les pages"
                    ],
                    "page_add" => [
                        'desc' => 'Ajouter une page'
                    ],
                    "page_edit" => [
                        'desc' => 'Modifier une page'
                    ],
                    "page_del" => [
                        'desc' => 'Supprimer une page'
                    ]
                ]
            ],
            'articles' => [
                'title' => 'Gestion des articles',
                'values' => [
                    "article_view" => [
                        "desc" => "Voir les articles"
                    ],
                    "article_add" => [
                        'desc' => 'Ajouter une article'
                    ],
                    "article_edit" => [
                        'desc' => 'Modifier une article'
                    ],
                    "article_del" => [
                        'desc' => 'Supprimer une article'
                    ]
                ]
            ],
            'comment' => [
                'title' => 'Gestion des commentaire',
                'values' => [
                    "comment_perm" => [
                        'desc' => 'Accepter/Refuser des commentaires '
                    ],
                ]
            ],
            "roles" => [
                "title" => "Gestion des roles",
                "values" => [
                    "role_view" => [
                        "desc" => "Voir les rôle"
                    ],
                    "role_add" => [
                        "desc" => "Ajouter un rôle"
                    ],
                    "role_edit" => [
                        "desc" => "Modifier un rôle"
                    ],
                    "role_del" => [
                        "desc" => "Supprimer un rôle"
                    ]
                ]
            ],
            "menus" => [
                "title" => "Gestion des menus",
                "values" => [
                    "menu_view" => [
                        "desc" => "Voir les menus"
                    ],
                    "menu_add" => [
                        "desc" => "Ajouter un menu"
                    ],
                    "menu_edit" => [
                        "desc" => "Modifier un menu"
                    ],
                    "menu_del" => [
                        "desc" => "Supprimer un menu"
                    ]
                ]
            ]
        ];
    }
}
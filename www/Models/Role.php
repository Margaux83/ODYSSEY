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
            ["id" ,"name"],
            ["isDeleted" => "0"]
        );
    }

    public function getPerms($value, $id) {
        $db = new Database("Role");
        $result = $db->query(
            ["value"],
            ["id" => $id]
        );
        $perms = json_decode($result[0]['value'], true);
        return $perms[$value] ?? false;
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
                    "/users" => [
                        "desc" => "Voir les utilisateurs"
                    ],
                    "/add-users" => [
                        "desc" => "Ajouter un utilisateur"
                    ],
                    "/edit-user" => [
                        "desc" => "Modifier un utilisateur"
                    ],
                    "/delete-user" => [
                        "desc" => "Supprimer un utilisateur"
                    ]

                ]
            ],
            'pages' => [
                'title' => 'Gestion des pages',
                'values' => [
                    "/pages" => [
                        "desc" => "Voir les pages"
                    ],
                    "/add-page" => [
                        'desc' => 'Ajouter une page'
                    ],
                    "/edit-page" => [
                        'desc' => 'Modifier une page'
                    ],
                    "/delete-page" => [
                        'desc' => 'Supprimer une page'
                    ]
                ]
            ],
            'articles' => [
                'title' => 'Gestion des articles',
                'values' => [
                    "/articles" => [
                        "desc" => "Voir les articles"
                    ],
                    "/add-article" => [
                        'desc' => 'Ajouter une article'
                    ],
                    "/edit-article" => [
                        'desc' => 'Modifier une article'
                    ],
                    "/delete-article" => [
                        'desc' => 'Supprimer une article'
                    ]
                ]
            ],
            'comment' => [
                'title' => 'Gestion des commentaire',
                'values' => [
                    "/comments" => [
                        'desc' => 'Accepter/Refuser des commentaires '
                    ],
                ]
            ],
            "roles" => [
                "title" => "Gestion des roles",
                "values" => [
                    "/roles" => [
                        "desc" => "Voir les rôles"
                    ],
                    "/add-role" => [
                        "desc" => "Ajouter un rôle"
                    ],
                    "/edit-role" => [
                        "desc" => "Modifier un rôle"
                    ],
                    "/delete-role" => [
                        "desc" => "Supprimer un rôle"
                    ]
                ]
            ],
            "menus" => [
                "title" => "Gestion des menus",
                "values" => [
                    "/menus" => [
                        "desc" => "Voir les menus"
                    ],
                    "/menu-add" => [
                        "desc" => "Ajouter un menu"
                    ],
                    "/menu-edit" => [
                        "desc" => "Modifier un menu"
                    ],
                    "/menu-delete" => [
                        "desc" => "Supprimer un menu"
                    ]
                ]
            ]
        ];
    }
}
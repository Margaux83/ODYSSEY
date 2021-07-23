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

    /**
     * @return array
     * Retorune tous les rôles de la base de données qui ne sont pas supprimés
     */
    public function getAllRoles()
    {
        $db = new Database("Role");
        return $result = $db->query(
            ["id" ,"name"],
            ["isDeleted" => "0"]
        );
    }

    /**
     * @param $value
     * @param $id
     * @return false|mixed
     * Retroune les permissions d'un rôle
     */
    public function getPerms($value, $id) {
        $db = new Database("Role");
        $result = $db->query(
            ["value"],
            ["id" => $id]
        );
        $perms = json_decode($result[0]['value'], true);
        return $perms[$value] ?? false;
    }

    /**
     * @return array
     * Retroune la liste des rôle sous forme de tableau où chaque permission est assignée à une uri
     */
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
            "users" => [
                "title" => "Gestion des utilisateurs",
                "values" => [
                    "/admin/users" => [
                        "desc" => "Voir les utilisateurs"
                    ],
                    "/admin/add-users" => [
                        "desc" => "Ajouter un utilisateur"
                    ],
                    "/admin/edit-user" => [
                        "desc" => "Modifier un utilisateur"
                    ],
                    "/admin/delete-user" => [
                        "desc" => "Supprimer un utilisateur"
                    ]

                ]
            ],
            'pages' => [
                'title' => 'Gestion des pages',
                'values' => [
                    "/admin/pages" => [
                        "desc" => "Voir les pages"
                    ],
                    "/admin/add-page" => [
                        'desc' => 'Ajouter une page'
                    ],
                    "/admin/edit-page" => [
                        'desc' => 'Modifier une page'
                    ],
                    "/admin/delete-page" => [
                        'desc' => 'Supprimer une page'
                    ]
                ]
            ],
            'articles' => [
                'title' => 'Gestion des articles',
                'values' => [
                    "/admin/articles" => [
                        "desc" => "Voir les articles"
                    ],
                    "/admin/add-article" => [
                        'desc' => 'Ajouter une article'
                    ],
                    "/admin/edit-article" => [
                        'desc' => 'Modifier une article'
                    ],
                    "/admin/delete-article" => [
                        'desc' => 'Supprimer une article'
                    ]
                ]
            ],
            'comment' => [
                'title' => 'Gestion des commentaire',
                'values' => [
                    "/admin/comments" => [
                        'desc' => 'Accepter/Refuser des commentaires '
                    ],
                ]
            ],
            "roles" => [
                "title" => "Gestion des roles",
                "values" => [
                    "/admin/roles" => [
                        "desc" => "Voir les rôles"
                    ],
                    "/admin/add-role" => [
                        "desc" => "Ajouter un rôle"
                    ],
                    "/admin/edit-role" => [
                        "desc" => "Modifier un rôle"
                    ],
                    "/admin/delete-role" => [
                        "desc" => "Supprimer un rôle"
                    ]
                ]
            ],
            "menus" => [
                "title" => "Gestion des menus",
                "values" => [
                    "/admin/menus" => [
                        "desc" => "Voir les menus"
                    ],
                    "/admin/menu-add" => [
                        "desc" => "Ajouter un menu"
                    ],
                    "/admin/menu-edit" => [
                        "desc" => "Modifier un menu"
                    ],
                    "/admin/menu-delete" => [
                        "desc" => "Supprimer un menu"
                    ]
                ]
            ]
        ];
    }

    //Fonction qui permet de build les options du select du Role de l'user
    public function buildAllRolesFormSelect($selectedRoleId = null) {
        $roles = $this->query(['id', 'name'], ['isDeleted'=>0]);
        $returnedArray = [
            '' => [
                "label" => "Choisir un rôle"
            ]
        ];

        foreach ($roles as $key => $role) {
            $returnedArray[$key+1] = [
                "label" => $role['name'],
                "selected" => $role['id'] === $selectedRoleId
            ];

        }
        return $returnedArray;
    }
}
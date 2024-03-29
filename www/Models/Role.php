<?php
namespace App\Models;

use App\Core\Database;
use App\Core\Helpers;

class Role extends Database
{
    private $id = null;
    protected $name;
    protected $value;

    public function __construct(){
        parent::__construct();
    }

    /**
     * @param $id
     * When an id is passed in parameter, we get the information of the corresponding role
     */
    public function setId($id){
        $this->id = $id;
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
     * Function that fetches information from registered roles that are not deleted
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
     * Function that fetches permissions from one role, the id of the role is passed in parameter
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
     */
    public function rolesList()
    {
        /*
        "all" => [
            "values" => [
                "all_perms" => [
                    "desc" => "Donner tous les droits"
                ]
            ]
        ],
         */
        return [
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
                        'desc' => 'Ajouter un article'
                    ],
                    "/admin/edit-article" => [
                        'desc' => 'Modifier un article'
                    ],
                    "/admin/delete-article" => [
                        'desc' => 'Supprimer un article'
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

    /**
     * @param null $selectedRoleId
     * @return \string[][]
     * Function to build the user's role select options
     */
    public function buildAllRolesFormSelect($selectedRoleId = null) {
        $roles = $this->query(['id', 'name'], ['isDeleted'=>0]);
        $returnedArray = [
            '' => [
                "label" => "Choisir un rôle"
            ]
        ];

        foreach ($roles as $key => $role) {
            $returnedArray[$role['id']] = [
                "label" => $role['name'],
                "selected" => $role['id'] === $selectedRoleId
            ];

        }
        return Helpers::cleanArray($returnedArray);

    }
}
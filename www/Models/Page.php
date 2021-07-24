<?php
namespace App\Models;

use App\Core\Database;
use App\Core\Form;

class Page extends Database
{
    protected $id;
    protected $title;
    protected $content;
    protected $description;
    protected $isvisible;
    protected $status;
    protected $isdeleted;
    protected $updateDate;
    protected $id_user;
    protected $uri;


    /**
     * User constructor.
     */
    public function __construct(){
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

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
     * @param $updateDate
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;
    }

    /**
     * @return mixed
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
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

    /**
     * @param $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    //Formbuilder des pages
    public function buildFormPage() {
        $form = new Form();
        return [
            "config"=>[
                "method"=>"POST",
                "Action"=>"pages",
                "Submit"=>"Publier",
                "class"=>"",
            ],

            "input"=>[
                "id_page"=>[
                    "type"=>"hidden",
                    "defaultValue"=>$this->getId()
                ],
                "title"=>[
                    "type"=>"text",
                    "label"=>"Veuillez choisir un titre pour votre page",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "error"=>"Le titre de la page doit faire entre 2 et 255 caractères",
                    "placeholder"=>"Votre titre",
                    "defaultValue"=>$this->getTitle()
                ],
                "content"=>[
                    "type"=>"textarea",
                    "label"=>"",
                    "lengthMin"=>"2",
                    "error"=>"Le contenu de la page doit faire entre 2 et 255 caractères",
                    "id"=>"full-featured-non-premium",
                    "placeholder"=>"Votre contenu",
                    "defaultValue"=>$this->getContent()
                ],
                "uri"=>[
                    "type"=>"text",
                    "label"=>"Veuillez choisir une uri pour votre page",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "error"=>"Votre uri doit faire entre 2 et 255 caractères",
                    "placeholder"=>"Uri",
                    "defaultValue"=>ltrim($this->getUri(), '/')
                ],
                "description"=>[
                    "type"=>"text",
                    "label"=>"Description",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "error"=>"La description de la page doit faire entre 2 et 255 caractères",
                    "id"=>"content",
                    "required"=>false,
                    "class"=>"textareaComment d-flex",
                    "placeholder"=>"Votre contenu",
                    "defaultValue"=>$this->getDescription()
                ],
                "status"=>[
                    "type"=>"select",
                    "label"=>"Statut",
                    "required"=>true,
                    "error"=>"Veuillez sélectionner un élément",
                    "placeholder"=>"Choisir un statut",
                    "options"=>$form->buildAllStatusFormSelect($this)
                ],
                "isvisible"=>[
                    "type"=>"select",
                    "label"=>"Visibilité",
                    "required"=>true,
                    "error"=>"Veuillez sélectionner un élément",
                    "placeholder"=>"Choisir une visibilité",
                    "options"=>$form->buildAllVisibilityFormSelect($this)
                ],
            ],

            "button"=>[
                "class"=>"buttonComponent d-flex floatRight",
                "name"=>"insert_page"
            ]
        ];
    }

    //Fonction qui va chercher les informations des pages enregistrées et qui ne sont pas supprimées
    public function getAllPages($id_user = null): array
    {
        $filter = ["isDeleted" => "0"];
        if(!empty($id_user)) {
            $filter = ["id_User" => $id_user];
        }
        $results = Page::query(
            ["id" ,"title", "description", "status", "uri", "creationDate", "updateDate", "id_User"],
            $filter
        );
        if (count($results)) {
            $user = new User();
            foreach ($results as $key => $result) {
                if (!empty($result['id_User'])) {
                    $userSelected = $user->query(['firstname', 'lastname'], ['id' => $result['id_User']])[0];
                    $results[$key]['firstname'] = $userSelected['firstname'];
                    $results[$key]['lastname'] = $userSelected['lastname'];
                }
            }
        }
        
        return $results;
    }
}
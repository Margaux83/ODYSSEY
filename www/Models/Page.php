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

        $data = array_diff_key(
            get_object_vars($this),
            get_class_vars(get_parent_class())
        );
        unset($data["category"]);
        $columns = array_keys($data);
        $statement = $this->pdo->prepare("SELECT " . implode(',', $columns) . " FROM ".$this->table." WHERE id=:id");
        $statement->execute(array(":id" => $this->getId()));
        //$result = $statement->fetchAll();

        $obj = $statement->fetchObject(__CLASS__);
        $this->setArticleFromObj($obj);

        $this->searchCategory();
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

    public function buildFormPage() {
        $form = new Form();
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
                    "label"=>"Veuillez choisir un titre pour votre page",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "class"=>"input",
                    "error"=>"Le titre de la page doit faire entre 2 et 255 caractères",
                    "placeholder"=>"Votre titre",
                    "defaultValue"=>""
                ],
                "content"=>[
                    "type"=>"textarea",
                    "label"=>"",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "error"=>"Le contenu de la page doit faire entre 2 et 255 caractères",
                    "id"=>"content",
                    "required"=>true,
                    "class"=>"trumbowygTextarea",

                    "placeholder"=>"Votre contenu",
                    "defaultValue"=>""
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
                    "defaultValue"=>""
                ],
                "uri"=>[
                    "type"=>"text",
                    "label"=>"Veuillez choisir une uri pour votre page",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "class"=>"input",
                    "error"=>"Votre uri doit faire entre 2 et 255 caractères",
                    "placeholder"=>"Uri",
                    "defaultValue"=>""
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
}
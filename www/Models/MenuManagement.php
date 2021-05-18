<?php


namespace App\Models;

use App\Core\Database;

class MenuManagement extends Database
{

    protected $id;
    protected $name;
    protected $creationdate;
    protected $editdate;
    protected $order;
    protected $route;
    protected $ody_menus_parent_id;
   

    public function __construct(){
        parent::__construct();
    }

    public function getID()
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
    }

    /**
     * @param $title
     */
    public function setName($name)
    {
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
     * @param $content
     */
    public function setCreationdate($creationdate)
    {
        $this->creationdate = $creationdate;
    }

    /**
     * @return mixed
     */
    public function getCreationdate()
    {
        return $this->creationdate;
    }

    /**
     * @param $status
     */
    public function setEditdate($editdate)
    {
        $this->editdate = $editdate;
    }

    /**
     * @return mixed
     */
    public function getEditdate()
    {
        return $this->editdate;
    }

    /**
     * @param $isvisible
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $category
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param $isdraft
     */
    public function setOdy_menus_parent_id($ody_menus_parent_id)
    {
        $this->ody_menus_parent_id = $ody_menus_parent_id;
    }

    /**
     * @return mixed
     */
    public function getOdy_menus_parent_id()
    {
        return $this->ody_menus_parent_id;
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
            "button"=>[
                "class"=>"buttonComponent d-flex floatRight",
                "name"=>"insert_menu"
            ],
            "input"=>[

                    "name"=>[

                        "type"=>"text",
                        "label"=>"Veuillez choisir un titre pour votre article",
                        "lengthMax"=>"255",
                        "lengthMin"=>"2",
                        "required"=>true,
                        "class"=>"input",
                        "error"=>"Le nom du menu doit faire entre 2 et 255 caractères"
                    ],
                    

                ]

        ];
    }
}
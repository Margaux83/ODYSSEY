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
        $columns = array_keys($data);
        $statement = $this->pdo->prepare("SELECT " . implode(',', $columns) . " FROM ".$this->table." WHERE id=:id");
        $statement->execute(array(":id" => $this->getId()));
        //$result = $statement->fetchAll();

       $obj = $statement->fetchObject(__CLASS__);

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
     * @param $isvisible
     */
    public function setOrderMenu($orderMenu)
    {
        $this->orderMenu = $orderMenu;
    }

    /**
     * @return mixed
     */
    public function getOrderMenu()
    {
        return $this->orderMenu;
    }

    **
     * @param $isvisible
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;
    }

    /**
     * @return mixed
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
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


    
    public function buildFormArticle()
    {
        return [

            "config"=>[
                "method"=>"POST",
                "Action"=>"",
                "Submit"=>"Créer",
                "class"=>"",

            ],
            
            "input"=>[

                    "name"=>[

                        "type"=>"text",
                        "label"=>"Veuillez choisir un titre pour votre menu",
                        "lengthMax"=>"255",
                        "lengthMin"=>"2",
                        "required"=>true,
                        "class"=>"input",
                        "error"=>"Le nom du menu doit faire entre 2 et 255 caractères"
                    ],

                    "orderMenu"=>[

                        "type"=>"checkbox",
                        "label"=>"",
                        "required"=>true,
                        "class"=>"input",
                        "error"=>""
                    ],
                ],

            "button"=>[
                "class"=>"buttonComponent d-flex floatRight",
                "name"=>"insert_menu"
            ],
                    

                ]

        ];
    }
}
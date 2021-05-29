<?php


namespace App\Models;

use App\Core\Database;

class Menus extends Database
{

    protected $id;
    protected $name;
    protected $orderMenu;
    protected $isDeleted;
   

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

    /**
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

    
    
    public function buildFormMenu()
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

                  /*  "orderMenu"=>[

                        "type"=>"checkbox",
                        "label"=>"",
                        "required"=>true,
                        "class"=>"input",
                        "error"=>""
                    ],*/
                ]
    

        ];
    }
}
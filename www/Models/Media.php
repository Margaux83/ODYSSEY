<?php
namespace App\Models;

use App\Core\Database;
use App\Core\Form;

class Media extends Database {


    protected $id;
    protected $name;
    protected $media;
    protected $isdeleted;


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

        $obj = $statement->fetchObject(__CLASS__);
        $this->setMediaFromObj($obj);

    }

    private function setMediaFromObj($obj){
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
     * @param mixed $name
     */
    public function setName($name): void
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
     * @param mixed $media
     */
    public function setMedia($media): void
    {
        $this->media = $media;
    }

    /**
     * @return mixed
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param mixed $isdeleted
     */
    public function setIsdeleted($isdeleted): void
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

    public function buildFormMedia()
    {
        return [

            "config"=>[
                "method"=>"POST",
                "Action"=>"",
                "Submit"=>"Publier",
                "class"=>"",
                "enctype"=>"multipart/form-data"
            ],

            "input"=>[

                "id"=>[
                    "type"=>"hidden",
                    "required"=>true,
                    "defaultValue"=>$this->getID()
                ],
                "name"=>[

                    "type"=>"text",
                    "label"=>"Veuillez choisir un nom pour votre media",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "error"=>"Le titre de l'article doit faire entre 2 et 255 caractères",
                    "placeholder"=>"Nom du média",

                    "defaultValue"=>$this->getName()
                ],
                "media"=>[
                    "type"=>"file",
                    "label"=>"Importez votre media",
                    "required"=>true,
                    "defaultValue"=>$this->getMedia()
                ]
            ],
            "button"=>[
                "class"=>"buttonComponent d-flex floatRight",
                "name"=>"insert_media"
            ]

        ];
    }


    public function buildFormMediaEdit()
    {
        return [

            "config"=>[
                "method"=>"POST",
                "Action"=>"",
                "Submit"=>"Publier",
                "class"=>"",
                "enctype"=>"multipart/form-data"
            ],

            "input"=>[

                "id"=>[
                    "type"=>"hidden",
                    "required"=>true,
                    "defaultValue"=>$this->getID()
                ],
                "name"=>[

                    "type"=>"text",
                    "label"=>"Veuillez choisir un nom pour votre media",
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "error"=>"Le titre de l'article doit faire entre 2 et 255 caractères",
                    "placeholder"=>"Nom du média",

                    "defaultValue"=>$this->getName()
                ]
            ],
            "button"=>[
                "class"=>"buttonComponent d-flex floatRight",
                "name"=>"insert_media"
            ]

        ];
    }


}
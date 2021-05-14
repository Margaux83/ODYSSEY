<?php


namespace App\Models;


use App\Core\Database;

class Category extends Database
{

    protected $id=null;
    protected $label;


    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /*public function buildFormCategory()
    {
        return [

            "config"=>[
                "method"=>"POST",
                "Action"=>"",
                "Submit"=>"Enregistrer",
                "class"=>"d-flex d-flex-wrap formModalOneInput",
            ],
            "input"=>[
                "addcategory"=>[
                    "type"=>"textarea",
                    "label"=>"Catégorie",
                    "required"=>true,
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "error"=>"Le titre de l'article doit faire entre 2 et 255 caractères"


                ]

            ]

        ];
    }*/
}
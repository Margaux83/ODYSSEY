<?php


namespace App\Models;


use App\Core\Database;

class Category extends Database
{

    protected $id=null;
    protected $label;
    protected $isdeleted;


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

    /**
     * @param mixed $isdeleted
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

    public function buildFormCategory()
    {
        return [

            "config"=>[
                "method"=>"POST",
                "Action"=>"",
                "Submit"=>"Enregistrer",
                "class"=>"d-flex d-flex-wrap formModalOneInput",
            ],
            "input"=>[
                "id"=>[
                    "type"=>"hidden",
                    "required"=>true,
                    "defaultValue"=>$this->getID()
                ],
                "label"=>[
                    "type"=>"text",
                    "label"=>"Catégorie",
                    "required"=>true,
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "placeholder"=>"Votre catégorie",
                    "error"=>"Le nom de la catégorie doit faire entre 2 et 255 caractères",
                    "defaultValue"=>$this->getLabel()
                ]

            ],
            "button"=>[
                "class"=>"buttonComponent d-flex",
                "name"=>"insert_category"
            ]


        ];
    }

    //Fonction qui permet de build les options du select de Catégorie de l'article
    public function buildAllCategoriesFormSelect($selectedCategoryId = null) {
        $categories = $this->query(['id', 'label']);
        $returnedArray = [
            '' => [
                "label" => "Choisir une catégorie"
            ]
        ];

        foreach ($categories as $key => $category) {
            $returnedArray[$key+1] = [
                "label" => $category['label'],
                "selected" => $category['id'] === $selectedCategoryId
            ];

        }
        return $returnedArray;
    }
}
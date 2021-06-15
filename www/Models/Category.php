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
                "addcategory"=>[
                    "type"=>"text",
                    "label"=>"Catégorie",
                    "class"=>"inputOneModal d-flex",
                    "required"=>true,
                    "lengthMax"=>"255",
                    "lengthMin"=>"2",
                    "error"=>"Le nom de la catégorie doit faire entre 2 et 255 caractères"
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
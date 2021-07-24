<?php


namespace App\Models;


use App\Core\Database;

class Category extends Database
{

    protected $id=null;
    protected $label;
    protected $isdeleted;


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

        $obj = $statement->fetchObject(__CLASS__);
        $this->setCategoryFromObj($obj);


    }

    private function setCategoryFromObj($obj){
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
        $categories = $this->query(['id', 'label'],['isDeleted'=>0]);
        $returnedArray = [
            '' => [
                "label" => "Choisir une catégorie"
            ]
        ];

        foreach ($categories as $key => $category) {
            $returnedArray[$category['id']] = [
                "label" => $category['label'],
                "selected" => $category['id'] === $selectedCategoryId
            ];

        }
        return $returnedArray;
    }

    //Retourne le label d'une catégorie si elle existe déjà dans la base de données
    public function getCategoryForVerification($id,$label)
    {
        return Category::query(
            ["label"],
            ["isDeleted" => "0", "label" => $label]
        );
    }
}
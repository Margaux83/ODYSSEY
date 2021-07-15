<?php

namespace App\Models;

use App\Core\Database;


class Menu extends Database
{
    protected $id;
    protected $name;
    protected $contentMenu;
    protected $isdeleted;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getContentMenu()
    {
        return $this->contentMenu;
    }

    /**
     * @param mixed $order
     */
    public function setContentMenu($contentMenu)
    {
        $this->contentMenu = $contentMenu;
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

    public function buildCreationForm()
    {
        return [
            "config" => [
                "method" => "POST",
                "Action" => "",
                "Submit" => "Créer le menu",
                "id" => 'creationMenuForm'
            ],
            "input" => [
                "id"=>[
                    "type"=>"hidden"
                ],
                "name"=>[
                    "type"=>"text",
                    "class"=>"form_input",
                    "label"=>"Nom du menu",
                    "lengthMax"=>"120",
                    "lengthMin"=>"2",
                    "required"=>true,
                    "error"=>"Le nom doit faire entre 2 et 120 caractères",
                    "placeholder"=>"Nom du menu"
                ],
                "contentMenu"=>[
                    "type"=>"hidden"
                ]
            ],
            "button"=>[
                "class"=>"buttonComponent d-flex floatRight",
                "name"=>""
            ]
        ];
    }
}
<?php

namespace App\Core;

class Form
{
    public static function validator($data, $config){

        $errors = [];

        if( count($data) == count($config["input"])){

            foreach ($config["input"] as $name => $configInput) {

                if( !empty($configInput["lengthMin"])
                    && is_numeric($configInput["lengthMin"])
                    && strlen($data[$name])<$configInput["lengthMin"] ){

                    $errors[] = $configInput["error"];

                }

            }

        }else{
            $errors[] = "Tentative de Hack (Faille XSS)";
        }

        return $errors; //tableau des erreurs
    }

    public static function showForm($form){
        $html = "<form class='".($form["config"]["class"]??"")."' method='".( self::cleanWord($form["config"]["method"]) ?? "GET" )."' action='".( $form["config"]["action"] ?? "" )."'>";


        foreach ($form["input"] as $name => $dataInput) {

            $html .="<div class='formElement'><label for='".$name."'>".($dataInput["label"]??"")." </label>";



            if ($dataInput["type"] === "select"){
                $html .= "<select 
                            id='".$name."' 
                            name='".$name."'
                            ".((!empty($dataInput["required"]))?"required='required'":"")."
                            >";


                foreach ($dataInput["options"] as $value => $optionValue) {
                    $html .= "<option
                            value='".$value."'
                            >".$optionValue['label']."
                        </option>";
                }

                $html .= "</select>";
            }
            elseif ($dataInput["type"] === "radio" || $dataInput["type"] === "checkbox"){
                foreach ($dataInput["options"] as $value => $optionValue) {
                    $html .= "<input type='".$dataInput["type"]."' id='".$value."' name='".$name."'>
                            <label for='".$value."'>".$optionValue["label"]."</label>";
                }
            }

            elseif ($dataInput["type"] === "textarea"){
                $html .= "<textarea 
                    id='".$name."'
                    class='".($dataInput["class"]??"")."' 
                    name='".$name."'
                    type='".($dataInput["type"] ?? "text")."'
                    placeholder='".($dataInput["placeholder"] ?? "")."'
                    ".((!empty($dataInput["required"]))?"required='required'":"")."
                    ".((!empty($dataInput["defaultValue"]))?"value='" . $dataInput["defaultValue"] . "'":"")."
                    >".$dataInput["innerHTML"]."
                    </textarea>";
            }

            else {
                $html .= "<input 
                            id='".$name."'
                             class='".($dataInput["class"]??"")."' 
                            name='".$name."'
                            type='".($dataInput["type"] ?? "text")."'
                            placeholder='".($dataInput["placeholder"] ?? "")."'
                            ".((!empty($dataInput["required"]))?"required='required'":"")."
                            ".((!empty($dataInput["defaultValue"]))?"value='" . $dataInput["defaultValue"] . "'":"")."
                            >";
            }

            $html .= "</div>";
        }


        $html .= "<div class='formSubmitElement'><input type='submit' value='".( self::cleanWord($form["config"]["Submit"]) ?? "Valider" )."'></div></form>";


        echo $html;
    }


    public static function cleanWord($word){
        return str_replace("'", "&apos;", $word);
    }

    //Fonction qui permet de build les options du select de Visibilté de l'article
    public function buildAllVisibilityFormSelect($object) {
        $status = [
            '' => [
                "label" => "Choisir une visibilité"
            ],
            "1"=>[
                "label" => "Protégé",
            ],
            "2"=>[
                "label" => "Public",
            ],
            "3"=>[
                "label" => "Privé"
            ]
        ];

        $returnedArray = [];

        foreach ($status as $key => $singleStatus) {
            $returnedArray[$key] = [
                'label' => $singleStatus['label'],
                'selected' => $key === $object->getIsvisible()
            ];
        }

        return $returnedArray;
    }

    //Fonction qui permet de build les options du select de Statut de l'article
    public function buildAllStatusFormSelect($object) {
        $status = [
            '' => [
                "label" => "Choisir un status"
            ],
            "1"=>[
                "label" => "Brouillon",
            ],
            "2"=>[
                "label" => "Créé",
            ],
            "3"=>[
                "label" => "En attente de validation"
            ],
            "4"=>[
                "label" => "Validé et posté"
            ]
        ];

        $returnedArray = [];

        foreach ($status as $key => $singleStatus) {
            $returnedArray[$key] = [
                'label' => $singleStatus['label'],
                'selected' => $key === $object->getStatus()
            ];
        }

        return $returnedArray;
    }
}
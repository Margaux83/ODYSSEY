<?php

namespace App\Core;

class Form
{
    /**
     * @param $data
     * @param $config
     * @return array
     * Check if there's en error on the form's data
     */
    public static function validator($data, $config){
        $errors = [];
        if( count($data) == count($config["input"])) {
            foreach ($config["input"] as $name => $configInput) {
                if (!empty($configInput["lengthMin"])
                    && is_numeric($configInput["lengthMin"])
                    && strlen($data[$name]) < $configInput["lengthMin"]) {
                    $errors[] = $configInput["error"];
                }

                if (!empty($configInput["lengthMax"])
                    && is_numeric($configInput["lengthMax"])
                    && strlen($data[$name]) > $configInput["lengthMax"]) {
                    $errors[] = $configInput["error"];
                }
            }
        }
        if(empty($_POST['csrf']) || !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
            $errors[] = "Formulaire non valide !";
        }
        unset($_SESSION['csrf']);
        return $errors;
    }

    /**
     * @param $form
     * @param bool $echoDirectly
     * @return string
     * Build the form with the information passed in the formbuilder array
     * Return the form and its properties
     */
    public static function showForm($form, $echoDirectly = true){
        $html = "<form ".(!empty($form["config"]["id"]) ? "id='ody_form_".$form["config"]["id"]."'": "")." class='".($form["config"]["class"]??"")."' method='".( self::cleanWord($form["config"]["method"]) ?? "GET" )."' action='".( $form["config"]["action"] ?? "" )."'  enctype='".( $form["config"]["enctype"] ?? "" )."'>";

        foreach ($form["input"] as $name => $dataInput) {
            $html .= "<div id='ody_inputContainer_".$name."' " . ($dataInput["type"] === "hidden" ? "" : "class='formElement'") . ">";

            if ($dataInput["type"] !== "hidden") {
                $html .= "<label for='".$name."'"
                        .((!empty($dataInput["required"])) 
                            ? $dataInput["required"] 
                                ? (!empty($dataInput["label"]))
                                    ? "class='requiredLabel'" 
                                    : ""
                                : ""
                            :"")." >"
                        .($dataInput["label"]??"")
                    ." </label>";
            }

            if ($dataInput["type"] === "textarea"){
                $html .= "<textarea 
                             id='".($dataInput["id"]??"")."'
                             class='".($dataInput["class"]??"")."' 
                            name='".$name."'
                            ".((!empty($dataInput["required"]))?"required='required'":"")."
                              placeholder='".($dataInput["placeholder"] ?? "")."'
                            ".((!empty($dataInput["required"]))?"required='required'":"")." 
                            ".((!empty($dataInput["disabled"]))?"disabled='disabled'":"")." 
                            ".((!empty($dataInput["readonly"]))?"readonly='readonly'":"")." 
                            >".((!empty($dataInput["defaultValue"]))?"" . $dataInput["defaultValue"] . "":"")."</textarea>";
                $html .= "<br>";
                $html .= "<br>";

            }
            elseif ($dataInput["type"] === "select"){

                $html .= "<select 
                            id='".$name."' 
                            name='".$name."'
                            ".((!empty($dataInput["required"]))?"required='required'":"")."
                            >";

                foreach ($dataInput["options"] as $value => $optionValue) {
                    $selected = false;
                    $searchSelected = array_key_exists('selected', $optionValue);
                    if ($searchSelected) {
                        $selected = $optionValue['selected'];
                    }

                    $html .= "<option
                            value='".$value."'
                            ". ($selected ? " selected" : ""). "
                            >".$optionValue['label']."
                        </option>";
                }

                $html .= "</select>";
            }
            elseif ($dataInput["type"] === "radio" || $dataInput["type"] === "checkbox"){
                foreach ($dataInput["options"] as $value => $optionValue) {
                    $html .= "<input type='".$dataInput["type"]."' id='".$value."' name='".$name."'  placeholder='".($dataInput["placeholder"] ?? "")."'
                    ".((!empty($dataInput["required"]))?"required='required'":"")."
                    ".((!empty($dataInput["defaultValue"]))?"value='" . $dataInput["defaultValue"] . "'":"").">
                            <label for='".$value."'>".$optionValue["label"]."</label>";
                }
            }


            else {
                $html .= "<input 
                            id='".$name."'
                             class='".($dataInput["class"]??"")."' 
                            name='".$name."'
                            type='".($dataInput["type"] ?? "text")."'
                            placeholder='".($dataInput["placeholder"] ?? "")."'
                            ".((!empty($dataInput["required"]))?"required='required'":"")." 
                            ".((!empty($dataInput["disabled"]))?"disabled='disabled'":"")."
                            ".((!empty($dataInput["readonly"]))?"readonly='readonly'":"")." 
                            ".((!empty($dataInput["defaultValue"]))?"value='" . $dataInput["defaultValue"] . "'":"")."
                            >";
            }

            $html .= "</div>";
        }

        $html .= "<div class='formSubmitElement'>"
            . "<button type='submit' id='".( self::cleanWord($form["button"]["id"] ?? "submitButton") ?? "submitButton" )."' name='".( self::cleanWord($form["button"]["name"] ?? "submitButton") ?? "" )."' value='".( self::cleanWord($form["config"]["Submit"] ?? "Valider" ) ?? "Valider" )."' class='".( self::cleanWord($form["button"]["class"] ?? "") ?? "" )."'>".( self::cleanWord($form["config"]["Submit"] ?? "Valider") ?? "Valider" )
            ."</button></div></form>";


        if ($echoDirectly) {
            echo $html;
        }else {
            return $html;
        }
    }

    /**
     * @param $word
     * @return array|string|string[]
     * Replace replace the apostrophe with a unicode
     */
    public static function cleanWord($word){
        return str_replace("'", "&apos;", $word);
    }

    /**
     * Function that allows you to build the options of the page's Visibility selector
     **/
    public function buildAllVisibilityFormSelect($object) {
        $status = [
            '' => [
                "label" => "Choisir une visibilité"
            ],
            "0"=>[
                "label" => "Brouillon",
            ],
            "1"=>[
                "label" => "Validé et posté",
            ]
        ];

        $returnedArray = [];
        foreach ($status as $key => $singleStatus) {
            $returnedArray[$key] = [
                'label' => $singleStatus['label'],
                'selected' => ($key === $object->getIsvisible() || $key == "0")
            ];
        }

        return $returnedArray;
    }

    /**
     * Function that allows you to build the options of the page's status select
     **/
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
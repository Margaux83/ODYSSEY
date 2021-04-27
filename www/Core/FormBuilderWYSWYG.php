<?php


namespace App\Core;


class FormBuilderWYSWYG
{
    public static function validator($data, $config){
        $errors = [];

        if( !empty($configInput["lengthMin"])
            && is_numeric($configInput["lengthMin"])
            && strlen($data[$name])<$configInput["lengthMin"] ){

            $errors[] = $configInput["error"];

        }

        if( !empty($configInput["lengthMax"])
            && is_numeric($configInput["lengthMax"])
            && strlen($data[$name])>$configInput["lengthMax"] ){
            $errors[] = $configInput["error"];

        }

        if ($configInput["type"] === 'date'){
            if( !empty($configInput["dateMin"])){
                if (date($configInput["dateMin"]) > $data[$name] ){
                    array_push($errors, "La date minimale est ". $configInput["dateMin"]);
                }
            }
            if( !empty($configInput["dateMax"])){
                if (date($configInput["dateMax"] < $data[$name] )){
                    array_push($errors, "La date minimale est ". $configInput["dateMax"]);
                }
            }
        }

        $errors[] = $configInput["error"];

        return $errors; //tableau des erreurs
    }

    public static function showFormArticle($form){
        $html = "<form class='".($form["config"]["class"]??"")."' method='".( self::cleanWord($form["config"]["method"]) ?? "GET" )."' action='".( $form["config"]["action"] ?? "" )."'>";

        foreach ($form["input"] as $name => $dataInput) {
            $html .= "&emsp;&emsp;";
            $html .="<label for='".$name."'>".($dataInput["label"]??"")." </label>";
            $html .= "&ensp;";


        if ($dataInput["type"] === "textarea"){
            $html .= "<textarea 
                            id='".$name."'
                             class='".($dataInput["class"]??"")."' 
                            name='".$name."'
                            ".((!empty($dataInput["required"]))?"required='required'":"")."
                            ></textarea>";
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


            else {
                $html .= "<input 
                            id='".$name."'
                             class='".($dataInput["class"]??"")."' 
                            name='".$name."'
                            type='".($dataInput["type"] ?? "text")."'
                            placeholder='".($dataInput["placeholder"] ?? "")."'
                            ".((!empty($dataInput["required"]))?"required='required'":"")."
                            >";
            }

        }

        $html .= "<br>";
        $html .= "<br>";

        $html .= "<button type='submit' value='".( self::cleanWord($form["config"]["Submit"]) ?? "Valider" )."' class='buttonComponent d-flex floatRight'>Publier</button></form>";


        echo $html;
    }


    public static function cleanWord($word){
        return str_replace("'", "&apos;", $word);
    }
}
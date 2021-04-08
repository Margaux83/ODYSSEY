<?php

namespace App\Core;

class FormBuilder
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

			$html .="<div><label for='".$name."'>".($dataInput["label"]??"")." </label>";



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

            $html .= "</div>";
		}
		

		$html .= "<input type='submit' value='".( self::cleanWord($form["config"]["Submit"]) ?? "Valider" )."'></form>";


		echo $html;
    }


	public static function cleanWord($word){
		return str_replace("'", "&apos;", $word);
	}
}
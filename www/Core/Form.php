<?php

namespace App\Core;

class Form
{

	public static function validator($data, $config){
		$errors = [];
		//echo "<pre>";
		//print_r($data);
		//print_r($config);

		//Est-ce que j'ai le bon nb d'inputs ?

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

			$html .="<label for='".$name."'>".($dataInput["label"]??"")." </label>";


			$html .= "<input 
						id='".$name."'
			 			class='".($dataInput["class"]??"")."' 
						name='".$name."'
						type='".($dataInput["type"] ?? "text")."'
						placeholder='".($dataInput["placeholder"] ?? "")."'
						".((!empty($dataInput["required"]))?"required='required'":"")."
						>";


		}
		

		$html .= "<input type='submit' value='".( self::cleanWord($form["config"]["Submit"]) ?? "Valider" )."'></form>";


		echo $html;
	}




	public static function cleanWord($word){
		return str_replace("'", "&apos;", $word);
	}

}
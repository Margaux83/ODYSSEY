<?php

namespace App\Core;

use App\Core\Form;
use App\Core\MenuBuilder;

class View
{
	// front_tpl.php
	private $template; // front ou back
	// default_view.php
	private $view; // default, dashboard, profile, ....
	private $data = [];

	public function __construct($view="default", $template="front"){
		$this->setTemplate($template);
		$this->setView($view);
		//$this->setErrorView($view);
	}

	public static function getAssets(string $nameFile){
		$explodedNameFile = explode(".", trim($nameFile));
		$nameFileType = array_pop($explodedNameFile);
		
		switch ($nameFileType){
			case "css" :
				echo SITEURL . '/public/styles/'.$nameFile;
				return;
			case ($nameFileType == "png" || $nameFileType == "jpg" || $nameFileType == "svg") :
				echo SITEURL . '/public/images/'.$nameFile;
				return;
			case ($nameFileType == "js") :
				echo SITEURL . '/public/scripts/js/'.$nameFile;
				return;
			default :
				return;
		}
	}

    public static function getActualPageTitle() {
		$actualPageInfo = MenuBuilder::getActualPageInfo();
		echo $actualPageInfo['label'] ?? '';
    }

	public function setTemplate($template){
		if(file_exists("Views/Templates/".$template."_tpl.php")){
			$this->template = "Views/Templates/".$template."_tpl.php";
		}else{
			die("Le template n'existe pas");
		}
	}

	public function setView($view){
		if(file_exists("Views/".$view."_view.php")){
			$this->view = "Views/".$view."_view.php";
		}else{
			die("La vue n'existe pas");
		}
	}

    public function addModal($modal, $config = [])
    {
        $pathModal = "Views/modals/" . $modal . ".mod.php";
        if (file_exists($pathModal)) {
            include $pathModal;
        } else {
            die("Le modal n'existe pas :" . $pathModal);
        }
    }

	public function assign($key, $value){
		$this->data[$key] = $value;
	}



	public function __destruct(){
		// $this->data = ["pseudo"=>"Prof"];  ----> $pseudo = "Prof";
		extract($this->data);
		include $this->template;
	}
}

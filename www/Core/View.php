<?php

namespace App\Core;

class View
{
	private $template;
	private $view;
	private $data = [];

	public function __construct($view="default", $template="front", $templateView = false){
		$this->setTemplate($template);
		$this->setView($view);

		if ($templateView !== false) {
			if(file_exists($templateView)){
				$this->view = $templateView;
			}
		}
	}

    /**
     * @param string $nameFile
     * Return the file passed in parameter and add it to a view or a template
     */
	public static function getAssets(string $nameFile){
		$explodedNameFile = explode(".", trim($nameFile));
		$nameFileType = array_pop($explodedNameFile);
		
		switch ($nameFileType){
			case "css" :
				echo Routing::getBaseUrl() . '/public/styles/'.$nameFile;
				return;
			case ($nameFileType == "png" || $nameFileType == "jpg" || $nameFileType == "svg" || $nameFileType == "jpeg") :
				echo Routing::getBaseUrl() . '/public/images/'.$nameFile;
				return;
			case ($nameFileType == "js") :
				echo Routing::getBaseUrl() . '/public/scripts/js/'.$nameFile;
				return;
			default :
				return;
		}
	}

    /**
     * Return the title of the page
     */
    public static function getActualPageTitle() {
		$actualPageInfo = MenuBuilder::getActualPageInfo();
		echo $actualPageInfo['label'] ?? '';
    }

    /**
     * @param $template
     * Return the template passed in parameter
     */
	public function setTemplate($template){
		if(file_exists("Views/Templates/".$template."_tpl.php")){
			$this->template = "Views/Templates/".$template."_tpl.php";
		}else{
			die("Le template n'existe pas");
		}
	}

    /**
     * @param $view
     * Return the view passed in parameter
     */
	public function setView($view){
		if(file_exists("Views/".$view."_view.php")){
			$this->view = "Views/".$view."_view.php";
		}else{
			die("La vue n'existe pas");
		}
	}


	public function assign($key, $value){
		$this->data[$key] = $value;
	}

	public function __destruct(){
		extract($this->data);
		include $this->template;
	}
}

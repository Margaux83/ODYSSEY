<?php

namespace App\Core;


class Routing{

	public $routesPath = "routes.yml";
	public $controller="Base";
	public $action="default";
	public $routes = [];
	public $slugs = [];


	public function __construct($uri){
		//Faut vérifier que le fichier existe
		$this->routes = yaml_parse_file($this->routesPath);
		//Faut vérifier qu'il y a un controller pour cette route
		if(!empty($this->routes[$uri])){
			$this->setController($this->routes[$uri]["controller"]);
			$this->setAction($this->routes[$uri]["action"]);
		}


		foreach ($this->routes as $slug=>$info) {
			$this->slugs[$info["controller"]][$info["action"]] = $slug;
		}

	}


	//PascalCase pour une class
	public function setController($controller){
		$this->controller=ucfirst(mb_strtolower($controller));
	}

	public function setAction($action){
		$this->action=$action."Action";
	}

	public function getController(){
		return $this->controller;
	}

	public function getAction(){
		return $this->action;
	}

	public function getControllerWithNamespace(){
		return APP_NAMESPACE.$this->controller;
	}


	/*
		/list-des-utilisateurs:
	  	controller: Security
	  	action: listofusers
	 */
	public function getUri($controller, $action){

		if(!empty($this->slugs[$controller]) && !empty($this->slugs[$controller][$action]))
			return $this->slugs[$controller][$action];


		die("Aucun route ne correspond à ".$controller." -> ".$action );
	}


}
/*
if(file_exists("routes.yml")){

	$listOfRoutes = yaml_parse_file("routes.yml");

	echo "<pre>";
	print_r($listOfRoutes);




	if(!empty($listOfRoutes[$uri]) 
		&& !empty($listOfRoutes[$uri]["controller"]) 
		&& !empty($listOfRoutes[$uri]["action"])){
		

		$c = $listOfRoutes[$uri]["controller"]."Controller";
		$a = $listOfRoutes[$uri]["action"]."Action";

		//Est-ce que j'ai les droits, si ce n'est pas le cas erreur access denied : 403

	}else{
		die("Erreur 404");
	}

}else{
	die("Le fichier de routing n'existe pas");
}
*/
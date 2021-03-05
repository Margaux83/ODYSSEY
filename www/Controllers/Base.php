<?php

namespace App;

use App\Core\Security;
use App\Core\View;


class Base{


	public function defaultAction($menuData, $actualUri){

		//Je vais cherche en bdd le pseudo du user
		$pseudo = "Prof";

		//Affiche moi la vue home;
		$view = new View();
		$view->assign("pseudo", $pseudo);
		$view->assign("age", 17);
		$view->assign("genre", "h", $menuData, $actualUri);

		//envoyer le pseudo à la vue
	}


	//Must be connected
	public function dashboardAction($menuData, $actualUri){
		
		$security = new Security(); 
		if(!$security->isConnected()){
			die("Error not authorized");
		}


		//Affiche moi la vue dashboard;
		$view = new View("dashboard", "back", $menuData, $actualUri);
		
		
	}


}
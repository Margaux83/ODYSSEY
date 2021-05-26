<?php
namespace App;


use App\Core\Routing; 
use App\Core\ConstantManager;
use App\Core\MenuBuilder;
use App\Core\View;

require "Autoloader.php";
Autoloader::register();

new ConstantManager();


$uriExploded = explode("?", $_SERVER["REQUEST_URI"]);
$uri = $uriExploded[0];

$route = new Routing($uri);
$menuData = $route->getMenuData();
$menuBuilder = MenuBuilder::getInstance($menuData, $uri);
$c = $route->getController();
$a = $route->getAction();

$cWithNamespace = $route->getControllerWithNamespace();

if( file_exists("./Controllers/".$c.".php")){

    include "./Controllers/".$c.".php";


    if(class_exists($cWithNamespace)){
        //$c = App\Security // User
        $cObject = new $cWithNamespace();

		if(method_exists($cObject, $a)){
			//$a = loginAction // defaultAction
			$cObject->$a();
		}else{
            header('Status: 404 Not found', true, 404);
            $view = new View("Error/404", "error");
        }


    }else{
        die("La classe ".$c." n'existe pas");
    }
}else {
    die("Le fichier " . $c . " n'existe pas");
}
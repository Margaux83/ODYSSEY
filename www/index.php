<?php
namespace App;


use App\Core\Routing; 
use App\Core\ConstantManager;
use App\Core\MenuBuilder;
use App\Core\View;
use App\Core\Security;
use App\Core\FrontPage;
use App\Core\Error;

// Class PHPMailer
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
            $security = Security::getInstance();
            if(!$security->isConnected()
                && MenuBuilder::needToBeConnected()){
               header('Location: /login');
            }else {
			    $cObject->$a();
            }
    
		}else{
            Error::errorPage(404, 'La page n\'existe pas');
        }

    }else{
        die("La classe ".$c." n'existe pas");
    }
}else {
    FrontPage::findContentToShow($uri);
}
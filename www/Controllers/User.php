<?php


namespace App;
use App\Core\Security;
use App\Core\View;

class User
{

    public function defaultAction($menuData, $actualUri)
    {
        $security = new Security();
        if(!$security->isConnected()){
            die("Error not authorized");
        }


        //Affiche moi la vue dashboard;
        $view = new View("users", "back", $menuData, $actualUri);

    }

}
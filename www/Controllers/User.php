<?php


namespace App;
use App\Core\Security;
use App\Core\View;

class User
{

    public function defaultAction($menuData, $actualUri)
    {
        //Affiche moi la vue dashboard;
        $view = new View("users", "back", $menuData, $actualUri);
    }

}
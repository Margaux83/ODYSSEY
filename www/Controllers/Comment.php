<?php


namespace App;
use App\Core\Security;
use App\Core\View;

class Comment
{

    public function defaultAction()
    {
        $security = new Security();
        if(!$security->isConnected()){
            die("Error not authorized");
        }


        //Affiche moi la vue dashboard;
        $view = new View("comment", "back");

    }

}
<?php


namespace App;

use App\Core\FormBuilderWYSWYG;
use App\Core\Security;
use App\Core\View;
use App\Core\ArticleRepository;

use App\Models\MenuManagement as Menu;

class MenuManagement
{

    public function defaultAction()
    {

        $security = Security::getInstance();
        /* if(!$security->isConnected()){
           die("Error not authorized");
       }*/



        //Affiche moi la vue dashboard;
        $view = new View("menuManagement", "back");

    }

    

}
<?php


namespace App;

use App\Core\Security;
use App\Core\View;

class Article
{

    public function defaultAction()
    {
        $security = new Security();
        if(!$security->isConnected()){
            die("Error not authorized");
        }


        //Affiche moi la vue dashboard;
        $view = new View("articles", "back");

    }

    public function addArticleAction()
    {
        $security = new Security();
        if(!$security->isConnected()){
            die("Error not authorized");
        }


        //Affiche moi la vue dashboard;
        $view = new View("addArticles", "back");

    }

    public function editArticleAction()
    {
        $security = new Security();
        if(!$security->isConnected()){
            die("Error not authorized");
        }


        //Affiche moi la vue dashboard;
        $view = new View("editArticles", "back");

    }
}
<?php


namespace App;

use App\Core\Security;
use App\Core\View;

class Article
{

    public function defaultAction($menuData, $actualUri)
    {
        $security = new Security();
        if(!$security->isConnected()){
            die("Error not authorized");
        }


        //Affiche moi la vue dashboard;
        $view = new View("articles", "back", $menuData, $actualUri);

    }

    public function addArticleAction($menuData, $actualUri)
    {
        $security = new Security();
        if(!$security->isConnected()){
            die("Error not authorized");
        }


        //Affiche moi la vue dashboard;
        $view = new View("addArticles", "back", $menuData, $actualUri);

    }

    public function editArticleAction($menuData, $actualUri)
    {
        $security = new Security();
        if(!$security->isConnected()){
            die("Error not authorized");
        }


        //Affiche moi la vue dashboard;
        $view = new View("editArticles", "back", $menuData, $actualUri);

    }
}
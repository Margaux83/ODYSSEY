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

    public function addMenu()
    {


        $security = Security::getInstance();
        //Vérifie si l'utilisateur est connecté, sinon on le redirige sur la page de login
        if (!$security->isConnected()) {
            header('Location: /login');
        }

        $menu = new Menu();
        
        //Affiche la vue pour ajouter un article
       // $view = new View("menuManagement, "back");

        //Création du formBuilder des articles
        $form = $article->buildFormArticle();
        $view->assign("form", $form);

        //On vérifie si des données sont bien envoyées
        if (!empty($_POST['insert_menu'])) {
            if (!empty($_POST)) {

                $errors = FormBuilderWYSWYG::validator($_POST, $form);
                //On vérifie s'il y a des erreurs
                if (empty($errors)) {
                    //S'il n'y a pas d'erreurs, on envoie les données dans la requête pour ajouter l'article
                    $menu->setName(htmlspecialchars(addslashes($_POST['name'])));
                    
                } else {
                    //S'il y a des erreurs, on prépare leur affichage
                    $view->assign("formErrors", $errors);
                }


            }
        }
        

    }

    

}
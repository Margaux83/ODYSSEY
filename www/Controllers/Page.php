<?php

namespace App;

use App\Core\Form;
use App\Core\View;
use App\Models\User;
use App\Models\Page as ModelPage;
use App\Core\Helpers;
use function Sodium\add;

class Page{

    public function defaultAction(){
        //Instanciation de la classe ModelPage
        $pages = new ModelPage;
        //Fonction pour récupérer la liste de toutes les pages
        $allPages = $pages->getAllPages();
        $allPagesByUser = $pages->getAllPages($_SESSION["userId"]);

        //Affiche moi la vue des pages
        $view = new View("Page/pages", "back");
        //Affiche la liste de toutes pages
        $view->assign("allPages", $allPages);
        $view->assign("allPagesByUser", $allPagesByUser);

    }

    public function addPageAction(){
        //Instanciation de la classe ModelPage
        $page = new ModelPage();
        //Affiche moi la vue pour l'ajout des pages
        $view = new View("Page/add_page", "back");

        //Création du formBuilder des pages
        $form = $page->buildFormPage();
        $view->assign("form", $form);

        //On vérifie si des données sont bien envoyées
        if (!empty($_POST['insert_page'])) {
            $dataPage = $_POST;
            foreach ($dataPage as $key => $value) {
                switch ($key) {
                    case "insert_page":
                        unset($dataPage["insert_page"]);
                        break;
                }
            }
        if(!empty($dataPage)) {
            $errors = Form::validator($dataPage, $form);
            //On vérifie s'il y a des erreurs
            if (empty($errors)) {
                //S'il n'y a pas d'erreurs, on envoie les données dans la requête pour ajouter l'article
                // Champs du formulaire
                $page->setTitle($dataPage['title']);
                $page->setContent($dataPage['content']);
                $page->setDescription($dataPage['description']);
                $page->setUri(str_replace(' ', '_', "/".$dataPage['uri']));
                $page->setStatus($dataPage['status']);
                $page->setIsvisible($dataPage['isvisible']);
                $page->setId_user($_SESSION["userId"]);
                // Champs par défaut
                $page->setIsdeleted(0);

                $page->save();

                $_SESSION['alert']['success'][] = "Votre page a bien été ajouté !";
                header('location: /admin/pages');
                session_write_close();
            }
            else {
                $_SESSION['alert']['danger'][] = $errors[0];
            }
        }
    }

    }

    public function editPageAction() {
        if(empty($_POST)) {
            $_SESSION['alert']['danger'][] = 'Vous ne pouvez pas aller sur ce lien';
            header('location: /admin/pages');
            session_write_close();
        }
        //Instanciation de la classe ModelPage
        $page = new ModelPage();
        //Affiche moi la vue pour la modification des pages
        $view = new View("Page/edit_page", "back");
        //On va récupérer les informations de la page en envoyant l'id dans le setId
        $page->setId($_POST["id_page"]);

        //Création du formBuilder des pages
        $form = $page->buildFormPage();
        $view->assign("form", $form);

        //On vérifie si des données sont bien envoyées et que le titre de la page a bien été renseigné
        if (!empty($_POST['insert_page'])) {
            $dataPage = $_POST;
            foreach ($dataPage as $key => $value) {
                switch ($key) {
                    case "insert_page":
                        unset($dataPage["insert_page"]);
                        break;
                }
            }
        if(!empty($dataPage) && !empty($dataPage['title'])) {
            $errors = Form::validator($dataPage, $form);
            //On vérifie s'il y a des erreurs
            if (empty($errors)) {
                //S'il n'y a pas d'erreurs, on envoie les données dans la requête pour modifier l'article
                // Champs du formulaire
                $page->setTitle($dataPage['title']);
                $page->setContent($dataPage['content']);
                $page->setDescription($dataPage['description']);
                $page->setUri(str_replace(' ', '_', "/".$dataPage['uri']));
                $page->setStatus($dataPage['status']);
                $page->setIsvisible($dataPage['isvisible']);
                $page->setId_user($_SESSION["userId"]);
                $page->setUpdateDate(date ('Y-m-d H:i:s'));

                // Champs par défaut
                $page->save();

                $_SESSION['alert']['success'][] = 'Votre modification a bien été prise en compte';
                header('location: /admin/pages');
                session_write_close();
            }
            else {
                $_SESSION['alert']['danger'][] = $errors[0];
            }
        }
    }
    }

    public function deletePageAction() {
        //Instanciation de la classe ModelPage
        $pages = new ModelPage;
        //Suppression d'une page grâce à son id
        if (!empty($_POST)) {
            if (!empty($_POST['deletePage'])) {
                $pages->delete($_POST['id_page']);
            }
        }
    }
}
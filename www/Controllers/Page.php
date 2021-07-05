<?php

namespace App;

use App\Core\Form;
use App\Core\View;
use App\Models\User;
use App\Models\Page as ModelPage;
use App\Core\Helpers;

class Page{
    public function defaultAction(){
        $pages = new ModelPage;
        $allPages = $pages->getAllPages();

        $view = new View("Page/pages", "back");
        $view->assign("allPages", $allPages);

        if (!empty($_POST)) {
            if (!empty($_POST['deletePage'])) {
                $pages->delete($_POST['id_page']);
            }
        }
    }
    public function addPageAction(){
        $page = new ModelPage();
        $view = new View("Page/add_page", "back");

        //Création du formBuilder des pages
        $form = $page->buildFormPage();
        $view->assign("form", $form);

        if(!empty($_POST)) {
            $errors = Form::validator($_POST, $form);
            if (empty($errors)) {
                // Champs du formulaire
                $page->setTitle(htmlspecialchars(addslashes($_POST['title'])));
                $page->setContent(addslashes($_POST['content']));
                $page->setDescription($_POST['description']);
                $page->setUri("/".$_POST['uri']);
                $page->setStatus($_POST['status']);
                $page->setIsvisible($_POST['isvisible']);
                $page->setId_user($_SESSION["userId"]);
                // Champs par défaut
                $page->setIsdeleted(0);

                $page->save();

                $_SESSION['alert']['success'][] = "Votre page a bien été ajouté !";
                header('location: /admin/pages');
                session_write_close();
            }
        }
    }
    public function editPageAction() {
        if(empty($_POST)) {
            $_SESSION['alert']['danger'][] = 'Vous ne pouvez pas aller sur ce lien';
            header('location: /admin/pages');
            session_write_close();
        }
        $page = new ModelPage();
        $view = new View("Page/edit_page", "back");
        $page->setId($_POST["id_page"]);

        //Création du formBuilder des pages
        $form = $page->buildFormPage();
        $view->assign("form", $form);

        if(!empty($_POST) && !empty($_POST['title'])) {
            $errors = Form::validator($_POST, $form);
            if (empty($errors)) {
                // Champs du formulaire
                $page->setTitle(htmlspecialchars(addslashes($_POST['title'])));
                $page->setContent(addslashes($_POST['content']));
                $page->setDescription($_POST['description']);
                $page->setUri("/".$_POST['uri']);
                $page->setStatus($_POST['status']);
                $page->setIsvisible($_POST['isvisible']);
                $page->setId_user($_SESSION["userId"]);
                $page->setUpdateDate(date ('Y-m-d H:i:s'));

                // Champs par défaut
                $page->setIsdeleted(0);

                $page->save();

                $_SESSION['alert']['success'][] = 'Votre modification a bien été prise en compte';
                header('location: /admin/pages');
                session_write_close();
            }
        }
    }
}
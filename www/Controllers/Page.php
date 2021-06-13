<?php

namespace App;

use App\Core\FormBuilderWYSWYG;
use App\Core\View;
use App\Models\User;
use App\Core\Form;
use App\Models\Page as ModelPage;
use App\Core\Helpers;

class Page{
    public function defaultAction(){
        $view = new View("Page/pages", "back");
    }
    public function addPageAction(){
        $page = new ModelPage();
        $view = new View("Page/add_page", "back");

        //Création du formBuilder des pages
        $form = $page->buildFormPage();
        $view->assign("form", $form);

        if(!empty($_POST)) {
            $errors = FormBuilderWYSWYG::validator($_POST, $form);
            if (empty($errors)) {
                Helpers::debug($_POST);
                // Champs du formulaire
                $page->setTitle(htmlspecialchars(addslashes($_POST['title'])));
                $page->setContent(addslashes($_POST['content']));
                $page->setDescription($_POST['description']);
                $page->setDescription($_POST['uri']);
                $page->setStatus($_POST['status']);
                $page->setIsvisible($_POST['isvisible']);

                // Champs par défaut
                $page->setIsdeleted(0);

                $page->save();


            }
        }
    }
}
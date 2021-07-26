<?php

namespace App;

use App\Core\Form;
use App\Core\View;
use App\Core\Helpers;
use App\Models\Page as ModelPage;

class Page{

    /**
     * Display the list of registered and undeleted pages in the database
     * Display of the list of pages added by the connected user
     */
    public function defaultAction(){

        $pages = new ModelPage;

        $allPages = $pages->getAllPages();
        $allPagesByUser = $pages->getAllPages($_SESSION["userId"]);

        $view = new View("Page/pages", "back");
        //Affiche la liste de toutes pages
        $view->assign("allPages", Helpers::cleanArray($allPages));
        $view->assign("allPagesByUser", Helpers::cleanArray($allPagesByUser));
    }

    /**
     * Function to add an article to the database
     */
    public function addPageAction(){

        $page = new ModelPage();

        $view = new View("Page/add_page", "back");

        $form = $page->buildFormPage();
        $view->assign("form", $form);

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
            if (empty($errors)) {
                $page->setTitle($dataPage['title']);
                $page->setContent($dataPage['content']);
                $page->setDescription($dataPage['description']);
                $page->setUri(str_replace(' ', '_', "/".$dataPage['uri']));
                //$page->setStatus($dataPage['status']);
                $page->setIsvisible($dataPage['isvisible']);
                $page->setId_user($_SESSION["userId"]);
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

    /**
     * Function to modify a page in the database
     * Retrieve and display the information of the page in the form thanks to the setId which takes in parameter the id of the page
     **/
    public function editPageAction() {
        if(empty($_POST)) {
            $_SESSION['alert']['danger'][] = 'Vous ne pouvez pas aller sur ce lien';
            header('location: /admin/pages');
            session_write_close();
        }

        $page = new ModelPage();
        $view = new View("Page/edit_page", "back");

        $page->setId($_POST["id_page"]);

        $form = $page->buildFormPage();
        $view->assign("form", $form);

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

            if (empty($errors)) {

                $page->setTitle($dataPage['title']);
                $page->setContent($dataPage['content']);
                $page->setDescription($dataPage['description']);
                $page->setUri(str_replace(' ', '_', "/".$dataPage['uri']));
                //$page->setStatus($dataPage['status']);
                $page->setIsvisible($dataPage['isvisible']);
                $page->setId_user($_SESSION["userId"]);
                $page->setUpdateDate(date ('Y-m-d H:i:s'));

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

    /**
     * Deleting a page using its Id
     */
    public function deletePageAction() {
        $pages = new ModelPage;
        if (!empty($_POST)) {
            if (!empty($_POST['deletePage'])) {
                $pages->delete($_POST['id_page']);
            }
        }
    }
}
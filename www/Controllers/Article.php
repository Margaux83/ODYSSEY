<?php


namespace App;

use App\Core\Form;
use App\Core\Helpers;
use App\Core\Security;
use App\Core\View;
use App\Models\Article as Article_Model;
use App\Models\Category;

class Article
{

    /**
     * Display the list of registered and undeleted articles in the database
     * Display of the list of articles added by the connected user
     */
    public function defaultAction()
    {
        $security = Security::getInstance();
         if(!$security->isConnected()){
             header('Location: /login');
         }
         $articles = new Article_Model();

        $view = new View("Article/articles", "back");
        $view->assign("infoArticles", Helpers::cleanArray($articles->getAllArticles()));
        $view->assign("infoArticlesByUser", Helpers::cleanArray($articles->getAllArticles($_SESSION["userId"])));
    }


    /**
     * Function to add an article to the database
     * With registration of the category of the article
     * We check if the uri already exists in the database, if so we send an error message
     * We add the prefix "/article/" before the uri to differentiate the uri of the articles and the pages
     */
    public function addArticleAction()
    {
        $security = Security::getInstance();
        if (!$security->isConnected()) {
            header('Location: /login');
        }

        $article = new Article_Model();

        $view = new View("Article/add_articles", "back");

        $form = $article->buildFormArticle();
        $view->assign("form", $form);

        if (!empty($_POST['insert_article'])) {
            $dataArticle = $_POST;
            foreach ($dataArticle as $key => $value) {
                switch ($key) {
                    case "insert_article":
                        unset($dataArticle["insert_article"]);
                        break;
                }
            }
            if (!empty($dataArticle)) {
                $errors = Form::validator($dataArticle, $form);
                if (empty($errors)) {
                    if(empty($article->query(['id'],["uri"=>"/article/".$dataArticle['uri']]))){
                        $article->setTitle($dataArticle['title']);
                        $article->setContent($dataArticle['content']);
                        $article->setIsvisible($dataArticle['isvisible']);
                        $article->setIsdeleted(0);
                        $article->setDescription($dataArticle["description"]);
                        $article->setId_user($_SESSION["userId"]);
                        $article->setUri(str_replace(' ', '_', "/article/".$dataArticle['uri']));

                        $article->save();
                        $result = $article->getLastFromTable();
                        $article->saveArticleCategory($dataArticle['category'], $result[0]["id"]);

                        $_SESSION['alert']['success'][] = 'L\'article a bien été enregistré !';
                        header('location: /admin/articles');
                        session_write_close();
                    } else {
                        $_SESSION['alert']['danger'][] = 'Cette uri existe déjà';
                    }
                } else {
                    $_SESSION['alert']['danger'][] = $errors[0];
                }
            }
        }
    }

    /**
     * Function to modify an article in the database
     * With registration of the category of the article
     * We check if the uri already exists in the database, if so we send an error message
     * We add the prefix "/article/" before the uri to differentiate the uri of the articles and the pages
     * Retrieve and display the information of the article in the form thanks to the setId which takes in parameter the id of the article
     */
    public static function editArticleAction()
    {
        $security = Security::getInstance();
         if(!$security->isConnected()){
             header('Location: /login');
         }
        $article = new Article_Model();

        $view = new View("Article/edit_articles", "back");

        if (!empty($_POST)) {
            if($_POST['id'] != "") {
                $article->setId($_POST["id"]);
            }
        }

        $form = $article->buildFormArticle();
        $view->assign("form", $form);


        if(!empty($_POST['insert_article'])) {
            $dataArticle = $_POST;
            foreach ($dataArticle as $key => $value) {
                switch ($key) {
                    case "insert_article":
                        unset($dataArticle["insert_article"]);
                        break;
                }
            }
            if (!empty($dataArticle)) {
                $errors = Form::validator($dataArticle, $form);
                if (empty($errors)) {
                    if(strlen($dataArticle['id']) == 0) {
                        $_SESSION['alert']['danger'][] = 'Veuillez sélectionner un article';
                    } else {
                        $article->setTitle($dataArticle['title']);
                        $article->setContent($dataArticle['content']);
                        $article->setDescription($dataArticle['description']);
                        $article->setIsvisible($dataArticle['isvisible']);
                        $article->setId_user($_SESSION["userId"]);

                        $article->setIsdeleted(0);
                        $uriverification = empty($article->getUriForVerification($_POST["id"],'/article/' . $dataArticle['uri']));
                            if ($uriverification) {
                                $article->setUri(str_replace(' ', '_', "/article/".$dataArticle['uri']));
                            } else {
                                $_SESSION['alert']['danger'][] = 'Cette uri existe déjà';
                            }
                            $article->save();
                            $article->updateCategoryOfArticle($dataArticle['id'],$dataArticle['category']);
                            $_SESSION['alert']['success'][] = 'L\'article a bien été modifié !';
                            if($uriverification){
                                header('location: /admin/articles');
                                session_write_close();
                            }
                        }
                    } else {
                    $_SESSION['alert']['danger'][] = $errors[0];
                }
                if (!empty($_POST)) {
                    if(!empty($_POST['id'])) {
                        $article->setId($_POST["id"]);
                    }
                }
                $form = $article->buildFormArticle();
                $view->assign("form", $form);
                $view->assign('article', $article);
            }
        }
    }

    /**
     * Deleting an article using its Id
     */
    public function deleteArticleAction() {
        $article = new Article_Model();

        if (!empty($_POST)) {
            if (!empty($_POST['deleteArticle'])) {
                $article->delete($_POST['id_article']);
            }
        }
    }

    /**
     * Displaythe list of registered and undeleted categories in the database
     * Possibility to add a category from this page, you cannot add a category that already exists in the database
     */
    public function categoriesAction()
    {
        $security = Security::getInstance();
        if(!$security->isConnected()){
            header('Location: /login');
        }

        $view = new View("Categories/categories", "back");
        $category = new Category();
        $listCategories = $category->query(['id','label', 'creationDate', 'updateDate'],['isDeleted'=>0]);
        $view->assign("listCategories", Helpers::cleanArray($listCategories));

        $formCategory = $category->buildFormCategory();
        $view->assign("formCategory", $formCategory);


        if(!empty($_POST['insert_category'])){
            $dataArticle = $_POST;
            foreach ($dataArticle as $key => $value) {
                switch ($key) {
                    case "insert_category":
                        unset($dataArticle["insert_category"]);
                        break;
                }
            }
            if (!empty($dataArticle)) {
                $errors = Form::validator($dataArticle, $formCategory);
                if (empty($errors)) {
                    if(!empty($category->query(['id'],['label'=>$dataArticle['label']]))){
                        $_SESSION['alert']['danger'][] = 'La catégorie existe déjà';
                    } else {
                        $category->setLabel($dataArticle["label"]);
                        $category->setIsdeleted(0);
                        $category->save();
                        $_SESSION['alert']['success'][] = 'La catégorie a bien été enregistrée !';
                        header('location: /admin/categories');
                        session_write_close();
                    }
                } else {
                    $_SESSION['alert']['danger'][] = $errors[0];
                }
            }
        }

    }


    /**
     * Function to modify a category, it cannot be given the name of a category that already exists in the database
     * Retrieve and display the category name in the form thanks to the setId which takes the id of the category in parameter
     **/
    public function editCategoryAction()
    {
        $security = Security::getInstance();
        if(!$security->isConnected()){
            header('Location: /login');
        }

        $view = new View("Categories/edit_categories", "back");
        $category = new Category();

        if (!empty($_POST)) {
            if($_POST['id'] != "") {
                $category->setId($_POST["id"]);
            }
        }

        $formCategory = $category->buildFormCategory();
        $view->assign("formCategory", Helpers::cleanArray($formCategory));

        if(!empty($_POST['insert_category'])){
            $dataArticle = $_POST;
            foreach ($dataArticle as $key => $value) {
                switch ($key) {
                    case "insert_category":
                        unset($dataArticle["insert_category"]);
                        break;
                }
            }
            if (!empty($dataArticle)) {

                $errors = Form::validator($dataArticle, $formCategory);
                if (empty($errors)) {
                    $uriverification = empty($category->getCategoryForVerification($_POST["id"],$dataArticle['label']));

                    if ($uriverification) {
                        $category->setLabel($dataArticle["label"]);
                        $category->save();
                        $_SESSION['alert']['success'][] = 'La catégorie a bien été modifiée !';
                        header('location: /admin/categories');
                        session_write_close();
                    } else {
                        $_SESSION['alert']['danger'][] = 'Cette catégorie existe déjà';
                    }
                } else {
                    $_SESSION['alert']['danger'][] = $errors[0];
                }

            }
        }
    }

    /**
     * Deleting a category using its Id
     */
    public function deleteCategoryAction() {
        $category = new Category();

        if (!empty($_POST)) {
            if (!empty($_POST['deleteCategory'])) {
                $category->delete($_POST['id_category']);
            }
        }
    }

}
<?php


namespace App;

use App\Core\Database;
use App\Core\Form;
use App\Core\Security;
use App\Core\View;
use App\Models\Article as Article_Model;
use App\Models\Category;

class Article
{

    /**
     * Affichage de la liste des articles enregistrés et non supprimés dans la base de données
     * Affichage de la liste des articles ajoutés par l'utilisateur connecté
     */
    public function defaultAction()
    {
        $security = Security::getInstance();
         if(!$security->isConnected()){
             header('Location: /login');
         }
         $articles = new Article_Model();

        $view = new View("Article/articles", "back");

        $view->assign("infoArticles", $articles->getAllArticles());
        $view->assign("infoArticlesByUser", $articles->getAllArticles($_SESSION["userId"]));
    }


    /**
     * Fonction d'ajout d'un article dans la base de données
     * Avec enregistrement de la catégorie de l'article
     * On vérifie si l'uri existe déjà dans la base de données, on envoie un message d'erreur
     * On ajout le préfixe "/article/" devant l'uri pour différencier les articles et les pages
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
                        $article->setStatus($dataArticle['status']);
                        $article->setIsvisible($dataArticle['isvisible']);
                        if ($dataArticle['status'] == "Brouillon") {
                            $article->setIsdraft(1);
                        } else {
                            $article->setIsdraft(0);
                        }
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
                    }else{
                        $_SESSION['alert']['danger'][] = 'Cette uri existe déjà';
                        header('location: /admin/add-article');
                        session_write_close();
                    }
                } else {
                    $_SESSION['alert']['danger'][] = $errors[0];
                }
            }
        }

    }

    /**
     * Fonction de modification d'un article dans la base de données
     * Avec enregistrement de la catégorie de l'article
     * On vérifie si l'uri existe déjà dans la base de données, on envoie un message d'erreur
     * On ajoute le préfixe "/article/" devant l'uri pour différencier les articles et les pages
     * Récupération et affichage des informations de l'article dans le formulaire grâce au setId qui prend en paramètre l'id de l'article
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

                        $article->setStatus($dataArticle['status']);
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
     * Suppression d'un article grâce à son Id
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
     * Affichage de la liste des catégories enregistrées et non supprimées dans la base de données
     * Posibilité d'ajouter une catégorie à partir de cette page, on ne peut pas ajouter une catégorie qui existe déjà dans la base de données
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
        $view->assign("listCategories", $listCategories);

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
     * Fonction de modification d'une catégorie, on ne peut pas lui donner le nom d'une catégorie qui existe déjà dans la base de données
     * Récupération et affichage du nom de la catégorie dans le formulaire grâce au setId qui prend en paramètre l'id de celle-ci
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
     * Suppression d'une catéorie grâce à son Id
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
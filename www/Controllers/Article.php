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
     * Affichage de la liste des articles enregistrés dans la base de données seulement pour les utilisateurs authentifiés
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
                        //Enregristrement de l'id de l'article et l'id de la catégorie dans la table intermédaire qui fait le lien entre les articles et les catégorie
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

    public static function editArticleAction()
    {
        $security = Security::getInstance();
        //Vérifie si l'utilisateur est connecté, sinon on le redirige sur la page de login
         if(!$security->isConnected()){
             header('Location: /login');
         }
         //Instanciation de la classe Article
        $article = new Article_Model();

        //Affiche la vue pour modifier un article
        $view = new View("Article/edit_articles", "back");

        //On va récupérer les informations de l'article en envoyant l'id dans le setId
        if (!empty($_POST)) {
            if($_POST['id'] != "") {
                $article->setId($_POST["id"]);
            }
        }

        //Création du formBuilder des articles
        $form = $article->buildFormArticle();
        $view->assign("form", $form);


        //On vérifie si des données sont bien envoyées
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
                    //On vérifie si un article a bien été sélectionné avant de faire la modification
                    if(strlen($dataArticle['id']) == 0) {
                        $_SESSION['alert']['danger'][] = 'Veuillez sélectionner un article';
                    } else {
                        //Modification de l'article sélectionné
                        $article->setTitle($dataArticle['title']);
                        $article->setContent($dataArticle['content']);
                        $article->setDescription($dataArticle['description']);

                        $article->setStatus($dataArticle['status']);
                        $article->setIsvisible($dataArticle['isvisible']);
                        $article->setId_user($_SESSION["userId"]);

                        // Champs par défaut
                        $article->setIsdeleted(0);
                        //On vérifie si l'uri existe dans la base de données pour un autre article
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
                    //S'il y a des erreurs, on prépare leur affichage
                    $_SESSION['alert']['danger'][] = $errors[0];
                }
                if (!empty($_POST)) {
                    if(!empty($_POST['id'])) {
                        $article->setId($_POST["id"]);
                    }
                }
                //Création du formBuilder des articles
                $form = $article->buildFormArticle();
                $view->assign("form", $form);
                $view->assign('article', $article);
            }
        }
    }

    public function deleteArticleAction() {
        //Instanciation de la classe article
        $article = new Article_Model();

        if (!empty($_POST)) {
            if (!empty($_POST['deleteArticle'])) {
                $article->delete($_POST['id_article']);
            }
        }
    }

    public function categoriesAction()
    {
        $security = Security::getInstance();
        //Vérifie si l'utilisateur est connecté, sinon on le redirige sur la page de login
        if(!$security->isConnected()){
            header('Location: /login');
        }

        //Affiche la vue des catégories
        $view = new View("Categories/categories", "back");
        //Instanciation de la classe Category
        $category = new Category();
        //On récupère, grâce à la fonction query, les informations de tous les articles
        $listCategories = $category->query(['id','label', 'creationDate', 'updateDate'],['isDeleted'=>0]);
        //Affiche la liste de tous les catégories
        $view->assign("listCategories", $listCategories);

        //Création du formBuilder des catégories
        $formCategory = $category->buildFormCategory();
        $view->assign("formCategory", $formCategory);

        //Suppression d'une catégorie grâce à son id
        if (!empty($_POST)) {
            if (!empty($_POST['deleteCategory'])) {
                $category->delete($_POST['id_category']);
            }
        }

        //On vérifie si des données sont bien envoyées
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
                    //On vérifie si la catégorie existe déjà dans la base de donnée
                    if(!empty($category->query(['id'],['label'=>$dataArticle['label']]))){
                        $_SESSION['alert']['danger'][] = 'La catégorie existe déjà';
                    } else {
                        //S'il n'y a pas d'erreurs, on envoie les données dans la requête pour ajouter la catégorie
                        $category->setLabel($dataArticle["label"]);
                        $category->setIsdeleted(0);
                        $category->save();
                        $_SESSION['alert']['success'][] = 'La catégorie a bien été modifiée !';
                        header('location: /admin/categories');
                        session_write_close();
                    }
                } else {
                    //S'il y a des erreurs, on prépare leur affichage
                    $_SESSION['alert']['danger'][] = $errors[0];
                }
            }
        }

    }


    public function editCategoryAction()
    {
        $security = Security::getInstance();
        //Vérifie si l'utilisateur est connecté, sinon on le redirige sur la page de login
        if(!$security->isConnected()){
            header('Location: /login');
        }

        //Affichage de la vue pour la modification de catégories
        $view = new View("Categories/edit_categories", "back");
        //Instanciation de la classe Category
        $category = new Category();

        //On va récupérer les informations de la catégorie en envoyant l'id dans le setId
        if (!empty($_POST)) {
            if($_POST['id'] != "") {
                $category->setId($_POST["id"]);
            }
        }

        //Création du formBuilder des catégories
        $formCategory = $category->buildFormCategory();
        $view->assign("formCategory", $formCategory);

        //On vérifie si des données sont bien envoyées
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
                    //On vérifie si la catégorie existe déjà dans la base de donnée
                    $uriverification = empty($category->getCategoryForVerification($_POST["id"],$dataArticle['label']));

                    if ($uriverification) {
                        //S'il n'y a pas d'erreurs, on envoie les données dans la requête pour modifier la catégorie
                        $category->setLabel($dataArticle["label"]);
                        $category->setIsdeleted(0);
                        $category->save();
                        $_SESSION['alert']['success'][] = 'La catégorie a bien été enregistrée !';
                        header('location: /admin/categories');
                        session_write_close();
                    } else {
                        $_SESSION['alert']['danger'][] = 'Cette catégorie existe déjà';
                    }
                } else {
                    //S'il y a des erreurs, on prépare leur affichage
                    $_SESSION['alert']['danger'][] = $errors[0];
                }

            }
        }
    }

    public function deleteCategoryAction() {
        //Instanciation de la classe Category
        $category = new Category();

        //Suppression d'une catégorie grâce à son id
        if (!empty($_POST)) {
            if (!empty($_POST['deleteCategory'])) {
                $category->delete($_POST['id_category']);
            }
        }
    }

}
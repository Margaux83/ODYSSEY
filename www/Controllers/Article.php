<?php


namespace App;

use App\Core\Database;
use App\Core\FormBuilderWYSWYG;
use App\Core\Messages;
use App\Core\Security;
use App\Core\View;
use App\Core\ArticleRepository;

use App\Models\Article as Arti;
use App\Models\Category;

class Article
{


    public function defaultAction()
    {

        $security = Security::getInstance();
        //Vérifie si l'utilisateur est connecté, sinon on le redirige sur la page de login
         if(!$security->isConnected()){
             header('Location: /login');
       }

        $article = new Arti();

        if (!empty($_POST)) {
            if (!empty($_POST['submit_delete_article'])) {
                //Suppression d'un article par son id
                $article->delete($_POST['id_delete_article']);
                $_SESSION['alert']['success'][] = 'Suppression effectuée avec succès !';
               // header('location: /articles');
            }
            if(!empty($_POST['submit_delete_article_of_user'])){
                //Suppression d'un article de l'utilisateur connecté par son id
                $article->delete($_POST['id_delete_article_of_user']);
                $_SESSION['alert']['success'][] = 'Suppression effectuée avec succès !';
              //  header('location: /articles');
            }
        }

        $articles = new Arti();
         //Fonction pour récupérer la liste de tous les articles
        $articles->getAllArticles();

        //Affiche moi la vue des articles;
        $view = new View("Article/articles", "back");

        //Affiche la liste de tous les articles
        $view->assign("infoArticlesByUser", $articles->getArticleByUser($_SESSION["userId"]));
        //Affiche la liste des articles qui ont été créés par l'utilisateur connecté
        $view->assign("infoArticles", $articles->getAllArticles());



        $form = $article->buildFormDeleteArticle();
        $view->assign("form", $form);
        $formDeleteArticleOfUser = $article->buildFormDeleteArticleOfUser();
        $view->assign("formDeleteArticleOfUser", $formDeleteArticleOfUser);

        //Fonctinnalité pour supprimer un article

    }



    public function addarticleAction()
    {


        $security = Security::getInstance();
        //Vérifie si l'utilisateur est connecté, sinon on le redirige sur la page de login
        if (!$security->isConnected()) {
            header('Location: /login');
        }

        $article = new Arti();
        $category = new Category();

        //Affiche la vue pour ajouter un article
        $view = new View("Article/add_articles", "back");

        //Création du formBuilder des articles
        $form = $article->buildFormArticle();
        $view->assign("form", $form);

        //Création du formBuilder des catégories
        $formCategory = $category->buildFormCategory();
        $view->assign("formCategory", $formCategory);

        //On vérifie si des données sont bien envoyées
        if (!empty($_POST['insert_article'])) {
            if (!empty($_POST)) {

                $errors = FormBuilderWYSWYG::validator($_POST, $form);
                //On vérifie s'il y a des erreurs
                if (empty($errors)) {
                    //S'il n'y a pas d'erreurs, on envoie les données dans la requête pour ajouter l'article
                    $article->setTitle(htmlspecialchars(addslashes($_POST['title'])));
                    $article->setContent(addslashes($_POST['content']));
                    $article->setStatus($_POST['status']);
                    $article->setIsvisible($_POST['isvisible']);
                    if ($_POST['status'] == "Brouillon") {
                        $article->setIsdraft(1);
                    } else {
                        $article->setIsdraft(0);
                    }
                    $article->setIsdeleted(0);
                    $article->setDescription($_POST["comment"]);
                    $article->setId_user($_SESSION["userId"]);
                    $result = $article->saveArticle();

                    $article->saveArticleCategory($_POST['category'], $result[0]["id"]);

                    $_SESSION['alert']['success'][] = 'L\'article a bien été enregistré !';
                } else {
                    //S'il y a des erreurs, on prépare leur affichage
                   // $view->assign("formErrors", $errors);
                    $_SESSION['alert']['danger'][] = "'.$errors.'";
                }


            }
        }
        //On vérifie si des données sont bien envoyées
        elseif(!empty($_POST['insert_category'])){
            if (!empty($_POST)) {

                $errors = FormBuilderWYSWYG::validator($_POST, $formCategory);
                if (empty($errors)) {
                    //S'il n'y a pas d'erreurs, on envoie les données dans la requête pour ajouter la catégorie
                    $category->setLabel($_POST["addcategory"]);
                    $category->save();
                    $_SESSION['alert']['success'][] = 'La catégorie a bien été enregistrée !';
                }
                else{
                    //S'il y a des erreurs, on prépare leur affichage
                   // $view->assign("formErrors", $errors);
                    $_SESSION['alert']['danger'][] = "'.$errors.'";
                }

            }
        }

    }

    public static function editarticleAction()
    {
        $security = Security::getInstance();
        //Vérifie si l'utilisateur est connecté, sinon on le redirige sur la page de login
         if(!$security->isConnected()){
           header('Location: /login');
       }

        $article = new Arti();

        //Fonction pour récupérer la liste de tous les articles
        $article->getAllArticles();

        //Affiche la vue pour modifier un article
        $view = new View("Article/edit_articles", "back");
        $view->assign("infoArticles", $article->getAllArticles());



        $article->setId($_POST["id_article"]);
        //var_dump($article);
        //var_dump($_POST["id_article"]);
        $view->assign("selectedArticle", $article);

        if(!empty($_POST["edit_article"])) {
            if(!empty($_POST)) {
                $article->setId($_POST["id_article"]);
            }
        }

        $form = $article->buildFormArticle();
        $view->assign("form", $form);




        //On vérifie si des données sont bien envoyées
        if(!empty($_POST['insert_article'])) {
            if (!empty($_POST)) {


                $errors = FormBuilderWYSWYG::validator($_POST, $form);

                if (empty($errors)) {
                    /*$article->setId($_POST["id_article"]);
                    $article->setTitle(htmlspecialchars(addslashes($_POST['title'])));
                    $article->setContent(htmlspecialchars(addslashes($_POST['content'])));
                    $article->setStatus($_POST['status']);
                    $article->setIsvisible($_POST['visibility']);
                    if ($_POST['status'] == "Brouillon") {
                        $article->setIsdraft(1);
                    } else {
                        $article->setIsdraft(0);
                    }
                    $article->setIsdeleted(0);
                    $article->setId_user($_SESSION["userId"]);
                    //$article->saveArticle();*/

                    //Modification de l'article sélectionné
                    $article->updateWithData($_POST);
                    $article->saveArticle();
                    $_SESSION['alert']['success'][] = 'L\'article a bien été modifié !';


                } else {
                    //S'il y a des erreurs, on prépare leur affichage
                    //$view->assign("formErrors", $errors);
                    $_SESSION['alert']['danger'][] = "'.$errors.'";
                }
                $view->assign('article', $article);


            }
        }

        }



}
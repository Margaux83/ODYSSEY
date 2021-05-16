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
         if(!$security->isConnected()){
             header('Location: /login');
       }

        $articles = new Arti();
        $articles->getAllArticles();

        //Affiche moi la vue des articles;
        $view = new View("Article/articles", "back");

        //Affiche la liste de tous les articles
        $view->assign("infoArticlesByUser", $articles->getArticleByUser($_SESSION["userId"]));
        //Affiche la liste des articles qui ont été créés par l'utilisateur connecté
        $view->assign("infoArticles", $articles->getAllArticles());

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


                } else {
                    //S'il y a des erreurs, on prépare leur affichage
                    $view->assign("formErrors", $errors);
                }


            }
        }
        elseif(!empty($_POST['insert_category'])){
            if (!empty($_POST)) {

                $errors = FormBuilderWYSWYG::validator($_POST, $formCategory);
                if (empty($errors)) {
                    $category->setLabel($_POST["addcategory"]);
                    $category->save();
                }
                else{
                    $view->assign("formErrors", $errors);
                }

            }
        }

    }

    public static function editarticleAction()
    {
        $security = Security::getInstance();
         if(!$security->isConnected()){
           header('Location: /login');
       }

        $article = new Arti();
        $article->getAllArticles();
        $view = new View("Article/edit_articles", "back");
        $view->assign("infoArticles", $article->getAllArticles());

        $form = $article->buildFormArticle();
        $view->assign("form", $form);

        //  if(!empty($_POST["edit_article"])) {
        //    if(!empty($_POST)) {
        $article->setId($_POST["id_article"]);
        $view->assign("selectedArticle", $article);
        //  }
        //}

      if(!empty($_POST["edit_article"])) {
          if(!empty($_POST)) {
                 $article->setId($_POST["id_article"]);
                $view->assign("selectedArticle", $article);
           }
      }

        if(!empty($_POST['insert_article'])) {
            if (!empty($_POST)) {


                $errors = FormBuilderWYSWYG::validator($_POST, $form);

                if (empty($errors)) {
                    $article->setId($_POST["id_article"]);
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
                    //$article->saveArticle();
                    $view->assign('article', $article);


                } else {
                    $view->assign("formErrors", $errors);
                }


            }
        }
        }



    public static function deletearticleAction($id)
    {
        $article = new Arti();
        $article->delete($id);
    }

}
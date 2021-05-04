<?php


namespace App;

use App\Core\Database;
use App\Core\FormBuilderWYSWYG;
use App\Core\Security;
use App\Core\View;
use App\Core\ArticleRepository;

use App\Models\Article as Arti;

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

        //Affiche moi la vue dashboard;
        $view = new View("articles", "back");

        $view->assign("infoArticlesByUser", $articles->getArticleByUser($_SESSION["userId"]));
        $view->assign("infoArticles", $articles->getAllArticles());

    }

    public function addarticleAction()
    {

        $security = Security::getInstance();
        if(!$security->isConnected()){
            header('Location: /login');
       }
        $article = new Arti();
        $view = new View("addArticles", "back");

        $form = $article->buildFormArticle();
        $view->assign("form", $form);



        if(!empty($_POST)){
            $errors = FormBuilderWYSWYG::validator($_POST, $form);

            if(empty($errors)){

                   $article->setTitle(htmlspecialchars(addslashes($_POST['title'])));
                   $article->setContent(addslashes($_POST['content']));
                   $article->setStatus($_POST['status']);
                   $article->setIsvisible($_POST['visibility']);
                   if($_POST['status'] == "Brouillon"){
                       $article->setIsdraft(1);
                   }
                   else{
                       $article->setIsdraft(0);
                   }
                   $article->setIsdeleted(0);
                   $article->setId_user(1);
                   $article->saveArticle();



            }else{
                $view->assign("formErrors", $errors);
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
        $view = new View("editArticles", "back");
        $view->assign("infoArticles", $article->getAllArticles());

        $form = $article->buildFormArticle();
        $view->assign("form", $form);



       if(!empty($_POST)){
            $view->assign("form", $form);

            $errors = FormBuilderWYSWYG::validator($_POST, $form);

            if(empty($errors)){
                $article->setID(7);
                $article->setTitle(htmlspecialchars(addslashes($_POST['title'])));
                $article->setContent(htmlspecialchars(addslashes($_POST['content'])));
                $article->setStatus($_POST['status']);
                $article->setIsvisible($_POST['visibility']);
                if($_POST['status'] == "Brouillon"){
                    $article->setIsdraft(1);
                }
                else{
                    $article->setIsdraft(0);
                }
                $article->setIsdeleted(0);
                $article->setId_user(1);
                $article->saveArticle();

            }else{
                $view->assign("formErrors", $errors);
            }

        }

    }

    public static function deletearticleAction(int $id)
    {
        $article = new Arti();
        $article->deleteArticle($id);
    }

}
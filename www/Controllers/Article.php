<?php


namespace App;

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
        /* if(!$security->isConnected()){
           die("Error not authorized");
       }*/



        //Affiche moi la vue dashboard;
        $view = new View("articles", "back");

    }

    public function addarticleAction()
    {

        $security = Security::getInstance();
        /* if(!$security->isConnected()){
           die("Error not authorized");
       }*/
        $article = new Arti();
        $view = new View("addArticles", "back");

        $form = $article->buildFormArticle();
        $view->assign("form", $form);



        /*if(!empty($_POST)){
            $view->assign("form", $form);

            $errors = FormBuilderWYSWYG::validator($_POST, $form);

            if(empty($errors)){

                   $article->setTitle(htmlspecialchars(addslashes($_POST['title'])));
                   $article->setContent(htmlspecialchars(addslashes($_POST['content'])));
                   $article->setStatus($_POST['status']);
                   $article->setVisibility($_POST['visibility']);
                   if($_POST['status'] == "Brouillon"){
                       $article->setIsdraft(1);
                   }
                   else{
                       $article->setIsdraft(0);
                   }
                   $article->setIsdeleted(0);
                   $article->setId_category($_POST['category']);
                   $article->setId_user(1);
                   $article->saveArticle();

            }else{
                $view->assign("formErrors", $errors);
            }

        }*/
    }

    public function editArticleAction()
    {
        $security = Security::getInstance();
        /* if(!$security->isConnected()){
           die("Error not authorized");
       }*/

        $article = new Arti();
        $view = new View("editArticles", "back");

        $form = $article->buildFormArticle();
        $view->assign("form", $form);



       /* if(!empty($_POST)){
            $view->assign("form", $form);

            $errors = FormBuilderWYSWYG::validator($_POST, $form);

            if(empty($errors)){

                $article->setTitle(htmlspecialchars(addslashes($_POST['title'])));
                $article->setContent(htmlspecialchars(addslashes($_POST['content'])));
                $article->setStatus($_POST['status']);
                $article->setVisibility($_POST['visibility']);
                if($_POST['status'] == "Brouillon"){
                    $article->setIsdraft(1);
                }
                else{
                    $article->setIsdraft(0);
                }
                $article->setIsdeleted(0);
                $article->setId_category($_POST['category']);
                $article->setId_user(1);
                $article->saveArticle();

            }else{
                $view->assign("formErrors", $errors);
            }

        }*/

    }

}
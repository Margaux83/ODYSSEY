<?php


namespace App;

use App\Core\Security;
use App\Core\View;

use App\Models\Article as Arti;

class Article
{

    public function defaultAction()
    {
        $security = new Security();
        if(!$security->isConnected()){
            die("Error not authorized");
        }


        //Affiche moi la vue dashboard;
        $view = new View("articles", "back");

    }

    public function addarticleAction()
    {
        $security = new Security();
        if(!$security->isConnected()){
            die("Error not authorized");
        }
      $article = new Arti();
        /*$article->setTitle("Titre de l'article");
        $article->setContent("Lorem Ipsum is simply dummy
         text of the printing and typesetting industry. Lorem Ipsum 
         has been the industry's standard dummy text ever since the 
         1500s, when an unknown printer took a galley of type and 
         scrambled it to make a type specimen book. It has survived 
         not only five centuries, but also the leap into electronic 
         typesetting, remaining essentially unchanged. It was popularised 
         in the 1960s with the release of Letraset sheets containing 
         Lorem Ipsum passages, and more recently with desktop publishing 
         software like Aldus PageMaker including versions of Lorem Ipsum.");
        $article->setStatus(1);
        $article->setVisibility(1);
        $article->setIsdraft(1);
        $article->setDescription("It is a long established 
        fact that a reader will be distracted by the readable content 
        of a page when looking at its layout. The point of using Lorem 
        Ipsum is that it has a more-or-less normal distribution of letters, 
        as opposed to using 'Content here, content here', making it look 
        like readable English. Many desktop publishing packages and web page 
        editors now use Lorem Ipsum as their default model text, and a search 
        for 'lorem ipsum' will uncover many web sites still in their infancy. 
        Various versions have evolved over the years, sometimes by accident, 
        sometimes on purpose (injected humour and the like).");
        $article->setIsdeleted(0);
        $article->setId_category(1);
        $article->setId_article_page(1);
        $article->setId_user(1);*/

        //var_dump($_POST['title']);
        //die();
       // $article->saveArticle();

        //Affiche moi la vue dashboard;


        $view = new View("addArticles", "back");


    }

    public function editArticleAction()
    {
        $security = new Security();
        if(!$security->isConnected()){
            die("Error not authorized");
        }


       /* $article = new Arti();
        $article->setID(1);
        $article->setTitle("Nouveau titre de l'article");
        $article->setContent("Lorem Ipsum is simply dummy
         text of the printing and typesetting industry. Lorem Ipsum 
         has been the industry's standard dummy text ever since the 
         1500s, when an unknown printer took a galley of type and 
         scrambled it to make a type specimen book. It has survived 
         not only five centuries, but also the leap into electronic 
         typesetting, remaining essentially unchanged. It was popularised 
         in the 1960s with the release of Letraset sheets containing 
         Lorem Ipsum passages, and more recently with desktop publishing 
         software like Aldus PageMaker including versions of Lorem Ipsum.");
        $article->setStatus(1);
        $article->setVisibility(1);
        $article->setIsdraft(1);
        $article->setDescription("It is a long established 
        fact that a reader will be distracted by the readable content 
        of a page when looking at its layout. The point of using Lorem 
        Ipsum is that it has a more-or-less normal distribution of letters, 
        as opposed to using 'Content here, content here', making it look 
        like readable English. Many desktop publishing packages and web page 
        editors now use Lorem Ipsum as their default model text, and a search 
        for 'lorem ipsum' will uncover many web sites still in their infancy. 
        Various versions have evolved over the years, sometimes by accident, 
        sometimes on purpose (injected humour and the like).");
        $article->setIsdeleted(0);
        $article->setId_category(1);
        $article->setId_article_page(1);
        $article->setId_user(1);
        //$article->saveArticle();*/

        //Affiche moi la vue dashboard;
        $view = new View("editArticles", "back");

    }

}
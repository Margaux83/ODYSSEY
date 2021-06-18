<?php


namespace App;

use App\Core\FormBuilderWYSWYG;
use App\Core\Security;
use App\Core\View;
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

         //Instanciation de la classe article
        $article = new Arti();

        if (!empty($_POST)) {
            if (!empty($_POST['deleteArticle'])) {
                $article->delete($_POST['id_article']);
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
            $dataArticle = $_POST;
            foreach ($dataArticle as $key => $value) {
                switch ($key) {
                    case "insert_article":
                        unset($dataArticle["insert_article"]);
                        break;
                }
            }
            if (!empty($dataArticle)) {

                $errors = FormBuilderWYSWYG::validator($dataArticle, $form);
                //On vérifie s'il y a des erreurs
                if (empty($errors)) {
                    //S'il n'y a pas d'erreurs, on envoie les données dans la requête pour ajouter l'article
                    $article->setTitle(htmlspecialchars(addslashes($dataArticle['title'])));
                    $article->setContent(addslashes($dataArticle['content']));
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
                    $article->setUri("/".$dataArticle['uri']);
                    //$article->setMedia($_FILES['media']['name']);

                   $article->save();
                   $result = $article->getLastFromTable();
                   $article->saveArticleCategory($dataArticle['category'], $result[0]["id"]);


                   /*$_SESSION['alert']['success'][] = 'L\'article a bien été enregistré !';
                   if(isset($_FILES['media']['name'])){
                      //  foreach ($_FILES['media']['error'] as $key => $error) {

                                $tmp_name = $_FILES['media']['tmp_name'];
                                // basename() peut empêcher les attaques de système de fichiers;
                                // la validation/assainissement supplémentaire du nom de fichier peut être approprié
                                $name = basename($_FILES['media']['name']);

                       try {
                           move_uploaded_file($tmp_name, "/public/upload/".$name);

                       }
                       catch (\Exception $e){
                         echo  $e->getMessage();
                       }

                            }
                            else{
                                echo "ok";
                            }*/
                       // }

                } else {
                    //S'il y a des erreurs, on prépare leur affichage
                    $_SESSION['alert']['danger'][] = $errors[0];
                }


            }
        }
        //On vérifie si des données sont bien envoyées
        elseif(!empty($_POST['insert_category'])){
            $dataArticle = $_POST;
            foreach ($dataArticle as $key => $value) {
                switch ($key) {
                    case "insert_category":
                        unset($dataArticle["insert_category"]);
                        break;
                }
            }
            if (!empty($dataArticle)) {

                $errors = FormBuilderWYSWYG::validator($dataArticle, $formCategory);
                if (empty($errors)) {
                    //S'il n'y a pas d'erreurs, on envoie les données dans la requête pour ajouter la catégorie
                    $category->setLabel($dataArticle["addcategory"]);
                    $category->save();
                    $_SESSION['alert']['success'][] = 'La catégorie a bien été enregistrée !';
                }
                else{
                    //S'il y a des erreurs, on prépare leur affichage
                    $_SESSION['alert']['danger'][] = $errors[0];
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

         //Instanciation de la classe Article
        $article = new Arti();


        //Affiche la vue pour modifier un article
        $view = new View("Article/edit_articles", "back");

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
                $errors = FormBuilderWYSWYG::validator($dataArticle, $form);

                if (empty($errors)) {

                    //On vérifie si un article a bien été sélectionné avant de faire la modification
                    if(strlen($dataArticle['id']) == 0) {
                        $_SESSION['alert']['danger'][] = 'Veuillez sélectionner un article';
                    }
                    else{
                        //Modification de l'article sélectionné
                        // Champs du formulaire
                        $article->setTitle(htmlspecialchars(addslashes($dataArticle['title'])));
                        $article->setContent(addslashes($dataArticle['content']));
                        $article->setDescription($dataArticle['description']);
                        $article->setUri("/".$dataArticle['uri']);
                        $article->setStatus($dataArticle['status']);
                        $article->setIsvisible($dataArticle['isvisible']);
                        $article->setId_user($_SESSION["userId"]);

                        // Champs par défaut
                        $article->setIsdeleted(0);

                        $article->save();
                        $_SESSION['alert']['success'][] = 'L\'article a bien été modifié !';
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
                $view->assign('article', $article);

            }
        }
    }
}
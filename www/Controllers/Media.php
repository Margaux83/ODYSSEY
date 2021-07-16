<?php

namespace App;

use App\Core\Form;
use App\Core\Security;
use App\Core\View;
use App\Models\User;
use App\Models\Media as ModelMedia;
use App\Core\Helpers;

class Media {
    /**
     * Affiche la page principale des médias où on va retrouver la liste des médias enregistrés dans la base de données
     * Il faut être connecté pour accéder à la page
     */
    public function defaultAction() {
        $security = Security::getInstance();
        if(!$security->isConnected()){
            header('Location: /login');
        }

        $view = new View("Media/medias", "back");
        $medias = new ModelMedia();
        //Fonction pour récupérer la liste de tous les médias
        $mediaInfos = $medias->query(['id', 'name', 'media', 'creationDate', 'updateDate'], ['isDeleted'=>0]);
        $view->assign("mediaInfos",$mediaInfos);

    }

    /**
     * Affiche la page d'ajout des médias où on va enregistrer un nouveau média dans la base de données
     * Upload des fichiers dans le dossier /www/public/uploads
     * Il faut être connecté pour accéder à la page
     */
    public function addMediaAction() {
        $security = Security::getInstance();
        //Vérifie si l'utilisateur est connecté, sinon on le redirige sur la page de login
        if(!$security->isConnected()){
            header('Location: /login');
        }

        $view = new View("Media/add_media", "back");

        $media = new ModelMedia;
        //Création du formBuilder des articles
        $form = $media->buildFormMedia();
        $view->assign("form", $form);

        if (!empty($_POST['insert_media'])) {
            $dataArticle = $_POST;
            foreach ($dataArticle as $key => $value) {
                switch ($key) {
                    case "insert_media":
                        unset($dataArticle["insert_media"]);
                        break;
                }
            }
            if (!empty($dataArticle)) {

                $errors = Form::validator($dataArticle, $form);
                //On vérifie s'il y a des erreurs

                if (empty($errors)) {

                    $target_dir = $_SERVER["DOCUMENT_ROOT"] . "/public/images/uploads/";
                    $target_file = $target_dir . basename($_FILES["media"]["name"]);
                    $uploadOk = 1;

                    if (file_exists($target_file)) {

                        unlink($target_file);
                        move_uploaded_file($_FILES["media"]["tmp_name"], $target_file);
                        $_SESSION['alert']['success'][] = 'Le média a bien été uploadé !';
                        $media->setName($dataArticle['name']);
                        $media->setMedia($_FILES['media']["name"]);
                        $media->setIsdeleted(0);
                        $media->save();
                        $_SESSION['alert']['success'][] = 'Le média a bien été enregistré !';
                        header('location: /admin/medias');
                        session_write_close();
                    } else {

                        if ($_FILES["media"]["size"] > 500000) {
                            $_SESSION['alert']['danger'][] = "Le fichier est trop volumineux.";
                            $uploadOk = 0;
                        }

                        if (!preg_match("/.(jpg|jpeg|png|svg)$/i", $target_file)) {
                            $_SESSION['alert']['danger'][] = "Seuls les fichiers JPG, JPEG, PNG, GIF et SVG sont autorisés.";
                            $uploadOk = 0;
                        }

                        if ($uploadOk == 0) {
                            $_SESSION['alert']['danger'][] = "Votre fichier n'a pas pu être uploadé";
                        } else {
                                move_uploaded_file($_FILES["media"]["tmp_name"], $target_file);

                                $media->setName($dataArticle['name']);
                                $media->setMedia($_FILES['media']["name"]);
                                $media->setIsdeleted(0);
                                $media->save();
                                $_SESSION['alert']['success'][] = 'Le média a bien été enregistré !';
                                $_SESSION['alert']['success'][] = 'Le média a bien été uploadé !';
                                header('location: /admin/medias');
                                session_write_close();
                        }
                    }
                }
                else {
                    $_SESSION['alert']['danger'][] = $errors[0];
                }
            }
        }
    }

    public function editMediaAction()
    {

        $security = Security::getInstance();
        //Vérifie si l'utilisateur est connecté, sinon on le redirige sur la page de login
        if(!$security->isConnected()){
            header('Location: /login');
        }

        $view = new View("Media/edit_medias", "back");
    }

    public function deleteMediaAction() {
        $media = new ModelMedia();

        if (!empty($_POST)) {
            if (!empty($_POST['deleteMedia'])) {
                $media->delete($_POST['id_media']);
            }
        }
    }
}
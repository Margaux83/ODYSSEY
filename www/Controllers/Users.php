<?php

namespace App;

use App\Core\FormBuilder;
use App\Core\Security;
use App\Core\View;
use App\Models\User as User;
use App\Core\Mailer;
use App\Models\BodyMail;


class Users{


    public function defaultAction(){
        $view = new View("User/users", "back");

        $user = new User();
        $selectUser = $user->query(
            ["id", "firstname", "lastname", "email", "status", "role", "creationDate", "lastConnexionDate"]
        );
        $view->assign('infoUser', $selectUser);
    }

    public function addUsersAction()
    {
        $security = Security::getInstance();
        //Vérifie si l'utilisateur est connecté, sinon on le redirige sur la page de login
        if (!$security->isConnected()) {
            header('Location: /login');
        }

        $user = new User();
        $mailer = new Mailer();
        $bodymail = new BodyMail();

        //Affiche la vue pour ajouter un utilisateur
        $view = new View("User/addUsers", "back");
        $token = rand(100000, 999999);

        //Création du formBuilder des utilisateurs
        $form = $user->buildFormRegisterBack();
        $view->assign("form", $form);

        if(!empty($_POST)){
            $view->assign("form", $form);

            $errors = FormBuilder::validator($_POST, $form);
            if(empty($errors)) {
                $user->setFirstname(htmlspecialchars(addslashes($_POST['firstname'])));
                $user->setLastname(htmlspecialchars(addslashes($_POST['lastname'])));
                $user->setEmail(htmlspecialchars(addslashes($_POST['email'])));
                $user->setPhone(htmlspecialchars(addslashes($_POST['phone'])));
                $user->setRole(1);
                $user->setIsDeleted(0);
                $user->setToken($token);
                $user->setIsVerified(0);
                $user->save();
                $object = "Email confirmation - ODYSSEY";;
                $mailer->sendMail($_POST['firstname'], $_POST['lastname'], $_POST['email'], $object, $bodymail->buildBodyMailConfirmationBack($_POST['email'], $token));
                $_SESSION['alert']['success'][] = 'Un mail de validation vous a été envoyé';
                header('location: /login');
                session_write_close();

            }
            else{
                $_SESSION['alert']['danger'][] = 'Les éléments du formulaire ne sont pas valides';
                $view->assign("formErrors", $errors);
            }

        }


    }

    public function editUsersAction()
    {
        $view = new View("User/editUsers", "back");

        $user = new User();
        $selectUser = $user->query(
            ["id", "firstname", "lastname", "email", "status", "role", "creationDate", "lastConnexionDate"]
        );
        $view->assign('infoUser', $selectUser);

        $form = $user->buildFormUpdateBack();
        $view->assign("form", $form);
    }


}
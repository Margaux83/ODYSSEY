<?php

namespace App;

use App\Core\Database;
use App\Core\Form;
use App\Core\Security;
use App\Core\Security as coreSecurity;
use App\Core\View;
use App\Models\User as User;
use App\Core\Mailer;
use App\Models\BodyMail;


class Users{

    public function defaultAction(){
        $view = new View("User/users", "back");

        $user = new User();

        if (!empty($_POST)) {
            if (!empty($_POST['deleteUser'])) {
                $user->delete($_POST['id_user']);
            }
        }

        $selectUser = $user->query(
            ["id", "firstname", "lastname", "email", "status", "role", "creationDate", "lastConnexionDate"],
            ["isDeleted" => "0"]
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
        $view = new View("User/add_users", "back");
        $token = rand(100000, 999999);

        //Création du formBuilder des utilisateurs
        $form = $user->buildFormRegisterBack();
        $view->assign("form", $form);

        if(!empty($_POST)){
            $view->assign("form", $form);

            $errors = Form::validator($_POST, $form);
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
                $_SESSION['alert']['success'][] = 'Un mail de validation a été envoyé à l\'utilisateur';
                header('location: /users');
                session_write_close();

            }
            else{
                $_SESSION['alert']['danger'][] = 'Les éléments du formulaire ne sont pas valides';
                $view->assign("formErrors", $errors);
            }

        }


    }

    public function newPasswordConfirmAction(){
        $coreSecurity = coreSecurity::getInstance();
        if ($coreSecurity->getConnectedUser()){
            header('Status: 400 Connected', true, 400);
            header('Location: /dashboard');
            return;
        }
        $view = new View("User/newPasswordConfirm", "back_management");

        if(!empty($_POST)) {
            $user = new User();

            $db = new Database("User");
            $result = $db->query(
                ["id"],
                ["token" => $_POST['token']]
            );
            if(count($result)) {
                $user->setId($result[0]["id"]);
                if(!$user->verifyPassword(htmlspecialchars(addslashes($_POST['password'])), htmlspecialchars(addslashes($_POST['password-confirm'])))) {
                    $_SESSION['alert']['danger'][] = 'Les deux mots de passe ne correspondent pas';
                    header('location: /newpasswordconfirm');
                    session_write_close();
                } else {
                    $user->setPassword(password_hash(htmlspecialchars(addslashes($_POST['password'])), PASSWORD_BCRYPT));
                    $user->setToken("");
                    $user->setIsVerified(1);
                    $user->save();
                    $_SESSION['alert']['success'][] = 'Votre mot de passe a bien été creé';
                    header('location: /login');
                    session_write_close();
                }
            } else {
                $_SESSION['alert']['danger'][] = 'Token incorrect';
            }
        }
    }

    public function editUsersAction() {

        $security = Security::getInstance();
        //Vérifie si l'utilisateur est connecté, sinon on le redirige sur la page de login
        if(!$security->isConnected()){
            header('Location: /login');
        }

        $user = new User();
        $view = new View("User/edit_users", "back");
        if (!empty($_POST)) {

            if($_POST['id_user'] != "") {
                $user->setId($_POST["id_user"]);
            }
        }

        $form = $user->buildFormUpdateBack();
        $view->assign("form", $form);
    }


}
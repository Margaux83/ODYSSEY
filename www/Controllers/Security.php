<?php

namespace App;

use App\Core\Security as coreSecurity;
use App\Core\Database;
use App\Core\View;
use App\Core\Form;
use App\Core\ConstantManager;
use App\Models\User;
use App\Core\FormBuilder;
use App\Core\Mailer;
use App\Models\BodyMail;



class Security{

    public function defaultAction(){
        echo "controller security action default";
    }


    public function registerAction(){
        $coreSecurity = coreSecurity::getInstance();
        if ($coreSecurity->getConnectedUser()){
            header('Status: 400 Connected', true, 400);
            header('Location: /dashboard');
            return;
        }

        $mailer = new Mailer();
        $bodymail = new BodyMail();
        $user = new User();
        $view = new View("User/register", "back_management");
        $token = bin2hex(openssl_random_pseudo_bytes(32));

        $form = $user->buildFormRegister();
        $view->assign("form", $form);
        if(!empty($_POST)){
            $view->assign("form", $form);

            $errors = FormBuilder::validator($_POST, $form);
            if(empty($errors)){
                $user->setFirstname(htmlspecialchars(addslashes($_POST['firstname'])));
                $user->setLastname(htmlspecialchars(addslashes($_POST['lastname'])));
                $user->setEmail(htmlspecialchars(addslashes($_POST['email'])));
                if($user->verifyPassword(htmlspecialchars(addslashes($_POST['password'])), htmlspecialchars(addslashes($_POST['password-confirm'])))) {
                    $user->setPassword(password_hash(htmlspecialchars(addslashes($_POST['password'])), PASSWORD_BCRYPT));
                }
                $user->setPhone(htmlspecialchars(addslashes($_POST['phone'])));
                $user->setRole(1);
                $user->setIsDeleted(0);
                $user->setToken($token);
                $user->setIsVerified(0);
                $user->save();
                $object = "Email confirmation - ODYSSEY";;
                $mailer->sendMail($_POST['firstname'], $_POST['lastname'], $_POST['email'], $object, $bodymail->buildBodyMailConfirmation($_POST['email'], $token));
                $_SESSION['alert']['success'][] = 'Un mail de validation vous a été envoyé';
                header('location: /login');
                session_write_close();
            }else{
                $_SESSION['alert']['danger'][] = 'Les éléments du formulaire ne sont pas valides';
                $view->assign("formErrors", $errors);
            }

        }

    }

    public function verificationAction() {
        if (!empty($_GET)) {

            if (isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['token']) && !empty($_GET['token'])) {
                $user = new User();

                $db = new Database("User");
                $result = $db->query(
                    ["id"],
                    ["email" => $_GET['email'], "token" => $_GET['token']]
                );
                if (count($result)){
                    $user->setId($result[0]["id"]);
                    $user->setIsVerified(1);
                    $user->setToken("");
                    $user->save();
                    // TODO Affichage du message après redirection ne fonctionne pas
                    $_SESSION['alert']['success'][] = 'Votre compte vient d\'être activé avec succès';
                    header('location: /login');
                    session_write_close();
                }
            }
        }
    }

    public function loginAction(){
        $coreSecurity = coreSecurity::getInstance();

        if ($coreSecurity->getConnectedUser()){
            header('Status: 400 Connected', true, 400);
            header('Location: /dashboard');
            return;
        }
        $view = new View("User/login", "back_management");
    }

    public function logoutAction(){
        $coreSecurity = coreSecurity::getInstance();
        unset($_SESSION["userId"]);
        header('Location: /login');
    }

    public function forgotPasswordAction(){
        $coreSecurity = coreSecurity::getInstance();
        if ($coreSecurity->getConnectedUser()){
            header('Status: 400 Connected', true, 400);
            header('Location: /dashboard');
            return;
        }
        $mailer = new Mailer();
        $bodymail = new BodyMail();
        $user = new User();
        $token = rand(100000, 999999);

        if(empty($_POST)){
            $view = new View("User/forgotPasswordSend", "back_management");
        } else {
            $view = new View("User/forgotPasswordSend", "back_management");

            $db = new Database("User");
            $result = $db->query(
                ["id", "isVerified", "firstname", "lastname"],
                ["email" => $_POST['email']]
            );
            if(count($result)) {
                if ($result[0]["isVerified"] == "1") {
                    $user->setId($result[0]["id"]);
                    $user->setToken($token);
                    $user->save();

                    $object = "Mot de passe oublie - ODYSSEY";
                    $mailer->sendMail($result[0]["firstname"], $result[0]["lastname"], $_POST['email'], $object, $bodymail->buildBodyForgotPassword($_POST['email'], $token));
                    $_SESSION['alert']['success'][] = 'Un mail contenant le token vient de vous être envoyé';
                    header('location: /forgotpasswordconfirm');
                    session_write_close();
                } else {
                    $_SESSION['alert']['danger'][] = 'Votre compte doit être activé';
                }
            } else {
                $_SESSION['alert']['danger'][] = 'Aucun compte reconnu';
            }


        }
    }

    public function forgotPasswordConfirmAction(){
        $coreSecurity = coreSecurity::getInstance();
        if ($coreSecurity->getConnectedUser()){
            header('Status: 400 Connected', true, 400);
            header('Location: /dashboard');
            return;
        }
        $view = new View("User/forgotPasswordConfirm", "back_management");

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
                    header('location: /forgotpasswordconfirm');
                    session_write_close();
                } else {
                    $user->setPassword(password_hash(htmlspecialchars(addslashes($_POST['password'])), PASSWORD_BCRYPT));
                    $user->setToken("");
                    $user->save();
                    $_SESSION['alert']['success'][] = 'Votre mot de passe a bien été modifié';
                    header('location: /login');
                    session_write_close();
                }
            } else {
                $_SESSION['alert']['danger'][] = 'Token incorrect';
            }
        }
    }

}
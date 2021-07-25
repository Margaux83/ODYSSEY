<?php

namespace App;

use App\Core\Security as coreSecurity;
use App\Core\Database;
use App\Core\View;
use App\Core\Form;
use App\Models\User;
use App\Core\Mailer;
use App\Models\BodyMail;



class Security{

    public function defaultAction(){
        echo "controller security action default";
    }

    /**
     * Function that allows to add a user in the database when he registers
     * An email is sent to him to confirm his account
     */
    public function registerAction(){
        $coreSecurity = coreSecurity::getInstance();
        if ($coreSecurity->getConnectedUser()){
            header('Status: 400 Connected', true, 400);
            header('Location: /admin/dashboard');
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
            $errors = Form::validator($_POST, $form);
            if(empty($errors)){
                if($user->verifyPassword($_POST['password'], $_POST['password-confirm'])) {
                    if($user->verifyEmail($_POST['email'])) {
                        $user->setFirstname($_POST['firstname']);
                        $user->setLastname($_POST['lastname']);
                        $user->setEmail($_POST['email']);
                        $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT));
                        $user->setPhone($_POST['phone']);
                        $user->setRole(1);
                        $user->setIsDeleted(0);
                        $user->setToken($token);
                        $user->setIsVerified(0);
                        $user->save();
                        $object = "Email confirmation - ODYSSEY";;
                        //Une fois que l'utilisateur s'est inscrit, un mail lui est envoyé pour qu'il confirme sont compte et il est rédirigé sur la page de connexion
                        $mailer->sendMail($_POST['firstname'], $_POST['lastname'], $_POST['email'], $object, $bodymail->buildBodyMailConfirmation($_POST['email'], $token));
                        $_SESSION['alert']['success'][] = 'Un mail de validation vous a été envoyé';
                        header('location: /login');
                        session_write_close();
                    }
                }
            }else{
                $_SESSION['alert']['danger'][] = $errors[0];
            }

        }

    }

    /**
     * Function which allows to verify the account of the user, a token is sent to him by email to confirm his identity
     */
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

    /**
     * Function that allows the user to connect to the CMS, once connected, he is redirected to the dashboard page
     */
    public function loginAction(){

        $coreSecurity = coreSecurity::getInstance();
        if ($coreSecurity->getConnectedUser()){
            header('Status: 400 Connected', true, 400);
            header('Location: /admin/dashboard');
            return;
        }

        $user = new User();
        $view = new View("User/login", "back_management");

        $form = $user->buildFormLogin();
        $view->assign("form", $form);
    }

    /**
     * Disconnection function
     */
    public function logoutAction(){
        $coreSecurity = coreSecurity::getInstance();
        unset($_SESSION["userId"]);
        header('Location: /login');
    }

    /**
     * Function that allows you to send an email to a user who has forgotten his password
     * In the email is a link that will redirect him to the password reset page
     */
    public function forgotPasswordAction(){
        $coreSecurity = coreSecurity::getInstance();
        if ($coreSecurity->getConnectedUser()){
            header('Status: 400 Connected', true, 400);
            header('Location: /admin/dashboard');
            return;
        }

        $mailer = new Mailer();
        $bodymail = new BodyMail();
        $user = new User();
        $token = rand(100000, 999999);


        if(empty($_POST)){
            $view = new View("User/forgotPasswordSend", "back_management");

            $form = $user->buildFormResetPassword();
            $view->assign("form", $form);

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
                $_SESSION['alert']['success'][] = 'Un mail contenant le token vient de vous être envoyé';
            }


        }
    }

    /**
     * Upon reaching the password reset form, the user can enter a new password and confirm it
     * The change of password will be taken into account in the database
     */
    public function forgotPasswordConfirmAction(){
        $coreSecurity = coreSecurity::getInstance();
        if ($coreSecurity->getConnectedUser()){
            header('Status: 400 Connected', true, 400);
            header('Location: /admin/dashboard');
            return;
        }

        $user = new User();
        $view = new View("User/forgotPasswordConfirm", "back_management");

        $form = $user->buildFormToken();
        $view->assign("form", $form);

        if(!empty($_POST)) {

            $db = new Database("User");
            $result = $db->query(
                ["id"],
                ["token" => $_POST['token']]
            );
            if(count($result)) {

                $user->setId($result[0]["id"]);
                if(!$user->verifyPassword($_POST['password'], $_POST['password-confirm'])) {
                    $_SESSION['alert']['danger'][] = 'Les deux mots de passe ne correspondent pas';
                    header('location: /forgotpasswordconfirm');
                    session_write_close();
                } else {
                    $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT));
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
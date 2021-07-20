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
     * Fonction qui permet d'ajouter un utilisateur dans la base de données quand il s'inscrit
     * Un mail lui est envoyé pour qu'il confirme son compte
     */
    public function registerAction(){
        $coreSecurity = coreSecurity::getInstance();
        //Lorque l'utilisateur se connecte, il est redirigé sur la page de dashboard
        if ($coreSecurity->getConnectedUser()){
            header('Status: 400 Connected', true, 400);
            header('Location: /admin/dashboard');
            return;
        }

        //Instanciation de la classe Mailer
        $mailer = new Mailer();
        //Instanciation de la classe BodyMail
        $bodymail = new BodyMail();
        //Instanciation de la classe User
        $user = new User();
        //Affichage de la vue d'inscription
        $view = new View("User/register", "back_management");
        //Création du token avec un nombre random long de 32 bit convertie en hexadécimal
        $token = bin2hex(openssl_random_pseudo_bytes(32));

        //Création du formBuilder de l'inscription
        $form = $user->buildFormRegister();
        $view->assign("form", $form);

        //On vérifie si des données sont bien envoyées
        if(!empty($_POST)){
            //On vérifie s'il y a des erreurs
            $errors = Form::validator($_POST, $form);
            if(empty($errors)){
                //On vérifie si un article a bien été sélectionné avant de faire la modification
                //Onvérifie si le mot de passe et le mot de passe de confirmation sont égaux
                if($user->verifyPassword(htmlspecialchars(addslashes($_POST['password'])), htmlspecialchars(addslashes($_POST['password-confirm'])))) {
                    //On vérifie que l'email n'existe pas déjà dans la base de données
                    if($user->verifyEmail(htmlspecialchars(addslashes($_POST['email'])))) {
                        $user->setFirstname(htmlspecialchars(addslashes($_POST['firstname'])));
                        $user->setLastname(htmlspecialchars(addslashes($_POST['lastname'])));
                        $user->setEmail(htmlspecialchars(addslashes($_POST['email'])));
                        $user->setPassword(password_hash(htmlspecialchars(addslashes($_POST['password'])), PASSWORD_BCRYPT));
                        $user->setPhone(htmlspecialchars(addslashes($_POST['phone'])));
                        $user->setRole(1);
                        $user->setIsDeleted(0);
                        $user->setToken($token);
                        $user->setIsVerified(0);
                        $user->save();
                        $object = "Email confirmation - ODYSSEY";;
                        //Une fois que l'utilisateur s'est inscrit, un mail lui est envoyé pour qu'il confirme sont compte et il est rédirigé sur la page de connexion
                        $mailer->sendMail($_POST['firstname'], $_POST['lastname'], $_POST['email'], $object, $bodymail->buildBodyMailConfirmation($_POST['email'], $token));
                        $_SESSION['alert']['success'][] = 'Un mail de validation vous a été envoyé';
                        //header('location: /login');
                        session_write_close();
                    }
                }
            }else{
                //S'il y a des erreurs, on prépare leur affichage
                $_SESSION['alert']['danger'][] = $errors[0];
            }

        }

    }

    /**
     * Fonction qui permet de vérifier le compte de l'utilisateur, un token lui est envoyé par mail pour confirmer son identité
     */
    public function verificationAction() {
        if (!empty($_GET)) {
            //Au moment de la vérification du compte, on vérifie si on reçoie bien un email et un token
            if (isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['token']) && !empty($_GET['token'])) {
                //Instanciation de la classe User
                $user = new User();

                //Instanciation de la classe Database avec en paramètre la classe User
                $db = new Database("User");
                //ON récupère l'id de l'utilisateur qui possède l'email et le token renseignés
                $result = $db->query(
                    ["id"],
                    ["email" => $_GET['email'], "token" => $_GET['token']]
                );
                //Si un utilisateur existe bel et bien dans la base de données, on passe le champ isVerifed à 1 pour dire que son compte a été vérifié
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
     * Fonction qui permet à l'utilisateur de se connecter au CMS, une fois connecté, il est rédirigé sur la page de dashboard
     */
    public function loginAction(){

        //Si l'utilisateur se connecte bien, on le redirige sur la page de dashboard
        $coreSecurity = coreSecurity::getInstance();
        if ($coreSecurity->getConnectedUser()){
            header('Status: 400 Connected', true, 400);
            header('Location: /admin/dashboard');
            return;
        }

        //Instanciation de la classe User
        $user = new User();
        //Affichage de la vue de connexion
        $view = new View("User/login", "back_management");

        //Création du formBuilder de la connexion
        $form = $user->buildFormLogin();
        $view->assign("form", $form);
    }

    /**
     * Fonction de déconnexion
     */
    public function logoutAction(){
        //Quand l'utilisateur se déconnecte, on détruit la session de son id et le redirige sur la page de connexion
        $coreSecurity = coreSecurity::getInstance();
        unset($_SESSION["userId"]);
        header('Location: /login');
    }

    /**
     * Fonction qui permet d'envoyer un mail à un utilisateur qui aurait oublié son mot de passe
     * Dans le mail se trouve un lien qui le redirigera sur la page de réinitialisation de mot de passe
     */
    public function forgotPasswordAction(){
        //Si l'utilisateur se connecte bien, on le redirige sur la page de dashboard
        $coreSecurity = coreSecurity::getInstance();
        if ($coreSecurity->getConnectedUser()){
            header('Status: 400 Connected', true, 400);
            header('Location: /admin/dashboard');
            return;
        }

        //Instanciation de la classe Mailer
        $mailer = new Mailer();
        //Instanciation de la classe BodyMail
        $bodymail = new BodyMail();
        //Instanciation de la classe User
        $user = new User();
        //Création d'un token sous la forme d'un nombre random entre 100000 et 999999
        $token = rand(100000, 999999);


        if(empty($_POST)){
            //On affiche la vue pour le mot de passe oublié
            $view = new View("User/forgotPasswordSend", "back_management");
        } else {
            //On affiche la vue pour le mot de passe oublié
            $view = new View("User/forgotPasswordSend", "back_management");

            //Instanciation de la classe Database avec en paramètre la classe User
            $db = new Database("User");
            //On  récupère les informations de l'utilisateur qui possède l'email renseigné
            $result = $db->query(
                ["id", "isVerified", "firstname", "lastname"],
                ["email" => $_POST['email']]
            );
            if(count($result)) {
                //Si l'utilisateur est vérifié, on créé un nouveau token
                if ($result[0]["isVerified"] == "1") {
                    $user->setId($result[0]["id"]);
                    $user->setToken($token);
                    $user->save();
                    //On envoie un mail contenant le token pour que l'utilisateur puisse réinitialiser son mot de passe
                    $object = "Mot de passe oublie - ODYSSEY";
                    $mailer->sendMail($result[0]["firstname"], $result[0]["lastname"], $_POST['email'], $object, $bodymail->buildBodyForgotPassword($_POST['email'], $token));
                    $_SESSION['alert']['success'][] = 'Un mail contenant le token vient de vous être envoyé';
                    header('location: /forgotpasswordconfirm');
                    session_write_close();
                } else {
                    $_SESSION['alert']['danger'][] = 'Votre compte doit être activé';
                }
            } else {
                // Même si on rentre une fausse adresse email ou que l'adresse email n'existe pas dans la base de données, on affiche un message de succès
                $_SESSION['alert']['success'][] = 'Un mail contenant le token vient de vous être envoyé';
            }


        }
    }

    /**
     * Lorsqu'il arrive sur le formulaire de réinitialisation du mot de passe, l'utilisateur peut entrer un nouveau mot de passe et le confirmer
     * Le changement de mot de passe sera pris en compte dans la base de données
     */
    public function forgotPasswordConfirmAction(){
        //Si l'utilisateur se connecte bien, on le redirige sur la page de dashboard
        $coreSecurity = coreSecurity::getInstance();
        if ($coreSecurity->getConnectedUser()){
            header('Status: 400 Connected', true, 400);
            header('Location: /admin/dashboard');
            return;
        }
        //Affichage de la vue pour réinitialiser son mot de passe
        $view = new View("User/forgotPasswordConfirm", "back_management");

        //On vérifie si des données sont bien envoyées
        if(!empty($_POST)) {
            //Instanciation de la classe User
            $user = new User();

            //Instanciation de la classe Database avec en paramètre la classe User
            $db = new Database("User");
            //On récupère l'id de l'utilisateur qui possède le token renseigné
            $result = $db->query(
                ["id"],
                ["token" => $_POST['token']]
            );
            if(count($result)) {

                $user->setId($result[0]["id"]);
                //On vérifie si le mot de passe et le mot de passe de confirmation sont égaux
                if(!$user->verifyPassword(htmlspecialchars(addslashes($_POST['password'])), htmlspecialchars(addslashes($_POST['password-confirm'])))) {
                    $_SESSION['alert']['danger'][] = 'Les deux mots de passe ne correspondent pas';
                    header('location: /forgotpasswordconfirm');
                    session_write_close();
                } else {
                    //Une fois le nouveau mot de passe renseigné, on fait le changement dans la base de données et on vide le token
                    $user->setPassword(password_hash(htmlspecialchars(addslashes($_POST['password'])), PASSWORD_BCRYPT));
                    $user->setToken("");
                    $user->save();
                    $_SESSION['alert']['success'][] = 'Votre mot de passe a bien été modifié';
                    header('location: /login');
                    session_write_close();
                }
            } else {
                //Si le token renseigné n'est pas le même que le token reçu par mail, on affiche un message d'erreur
                $_SESSION['alert']['danger'][] = 'Token incorrect';
            }
        }
    }

}
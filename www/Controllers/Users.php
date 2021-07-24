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
use App\Core\Statistic;



class Users{

    public function defaultAction(){

        //Instanciation de la classe User
        $user = new User();
        $allUsers = $user->getAllUsers();

        //Affichage de la vue des utilisateur;
        $view = new View("User/users", "back");

        //Statistique des utilisateurs
        $statisticsPages = Statistic::getSimpleStatistics(
            [
                [
                    'label' => 'Utilisateurs',
                    'element' => 'User',
                    'filter' => [
                        'isDeleted' => 0
                    ]
                ],
                [
                    'label' => 'Utilisateurs vérifié',
                    'element' => 'User',
                    'filter' => [
                        'isVerified' => 1
                    ]
                ],
                [
                    'label' => 'Utilisateurs non vérifié',
                    'element' => 'User',
                    'filter' => [
                        'isVerified' => 0
                    ]
                ]
            ]
        );

        //Affiche la liste des utilisateurs enregistrés
        $view->assign('allUsers', $allUsers);
        $view->assign("statistics", $statisticsPages);

    }

    public function addUsersAction()
    {
        $security = Security::getInstance();
        //Vérifie si l'utilisateur est connecté, sinon on le redirige sur la page de login
        if (!$security->isConnected()) {
            header('Location: /login');
        }

        //Instanciation de la classe User
        $user = new User();
        //Instanciation de la classe Mailer
        $mailer = new Mailer();
        //Instanciation de la classe BodyMail
        $bodymail = new BodyMail();

        //Affiche la vue pour ajouter un utilisateur
        $view = new View("User/add_users", "back");
        $token = rand(100000, 999999);

        //Création du formBuilder des utilisateurs
        $form = $user->buildFormRegisterBack();
        $view->assign("form", $form);

        //On vérifie si des données sont bien envoyées
        if(!empty($_POST)){
            $view->assign("form", $form);
            $errors = Form::validator($_POST, $form);

            if(empty($errors)) {
                //S'il n'y a pas d'erreurs, on envoie les données dans la requête pour ajouter l'utilisateur
                //On vérifie si l'email a bien été renseigné
                if ($user->verifyEmail(htmlspecialchars(addslashes($_POST['email'])))) {
                    $user->setFirstname(htmlspecialchars(addslashes($_POST['firstname'])));
                    $user->setLastname(htmlspecialchars(addslashes($_POST['lastname'])));
                    $user->setEmail(htmlspecialchars(addslashes($_POST['email'])));
                    $user->setPhone(htmlspecialchars(addslashes($_POST['phone'])));
                    $user->setRole(htmlspecialchars(addslashes($_POST['role'])));
                    $user->setIsDeleted(0);
                    $user->setToken($token);
                    $user->setIsVerified(0);
                    $user->save();
                    $object = "Email confirmation - ODYSSEY";;
                    $mailer->sendMail($_POST['firstname'], $_POST['lastname'], $_POST['email'], $object, $bodymail->buildBodyMailConfirmationBack($_POST['email'], $token));
                    $_SESSION['alert']['success'][] = 'Un mail de validation a été envoyé à l\'utilisateur';
                    header('location: /admin/users');
                    session_write_close();

                }
            }
            else{
                //S'il y a des erreurs, on prépare leur affichage
                $_SESSION['alert']['danger'][] = 'Les éléments du formulaire ne sont pas valides';
            }

        }

    }

    public function newPasswordConfirmAction(){
        $coreSecurity = coreSecurity::getInstance();
        if ($coreSecurity->getConnectedUser()){
            header('Status: 400 Connected', true, 400);
            header('Location: /admin/dashboard');
            return;
        }

        //Affiche moi la vue pour confirmer son nouveau mot de passe
        $view = new View("User/newPasswordConfirm", "back_management");

        //On vérifie si des données sont bien envoyées
        if(!empty($_POST)) {
            //Instanciation de la classe User
            $user = new User();
            //Instanciation de la classe Database avec la classe User passée en paramètre
            $db = new Database("User");
            $result = $db->query(
                ["id"],
                ["token" => $_POST['token']]
            );
            if(count($result)) {
                $user->setId($result[0]["id"]);
                //On vérifie que le nouveau mot de passe et le mot de passe de confirmation sont égaux
                if(!$user->verifyPassword(htmlspecialchars(addslashes($_POST['password'])), htmlspecialchars(addslashes($_POST['password-confirm'])))) {
                    $_SESSION['alert']['danger'][] = 'Les deux mots de passe ne correspondent pas';
                    header('location: /newpasswordconfirm');
                    session_write_close();
                } else {
                    //Si les mots de passe sont égaux, on enregistre le nouveau de passe dans la base de données avec une clé de chiffrement
                    $user->setPassword(password_hash(htmlspecialchars(addslashes($_POST['password'])), PASSWORD_BCRYPT));
                    $user->setToken("");
                    $user->setIsVerified(1);
                    $user->save();
                    $_SESSION['alert']['success'][] = 'Votre mot de passe a bien été creé. Connectez-vous à votre compte';
                    header('location: /login');
                    session_write_close();
                }
            } else {
                //S'il y a des erreurs, on prépare leur affichage
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

        //Instanciation de la classe User
        $user = new User();
        //Affiche moi la vue pour modifier les utilisateurs
        $view = new View("User/edit_users", "back");
        //On va récupérer les informations de l'utilisateur en envoyant l'id dans le setId
        $user->setId($_POST["id_user"]);

        //Création du formBuilder des utilisateurs
        $form = $user->buildFormUpdateBack();
        $view->assign("form", $form);

        //On vérifie si des données sont bien envoyées et que le nom de famille n'est pas vide
        if(!empty($_POST) && !empty($_POST['lastname'])){
            $errors = Form::validator($_POST, $form);
            if(empty($errors)) {
                //S'il n'y a pas d'erreurs, on envoie les données dans la requête pour ajouter l'utilisateur
                    $user->setFirstname(htmlspecialchars(addslashes($_POST['firstname'])));
                    $user->setLastname(htmlspecialchars(addslashes($_POST['lastname'])));
                    $user->setPhone(htmlspecialchars(addslashes($_POST['phone'])));
                    $user->setUpdateDate(date ('Y-m-d H:i:s'));
                    $user->setRole($_POST['role']);

                    // Champs par défaut
                    $user->setIsDeleted(0);
                    $user->setIsVerified(1);
                    $user->save();

                    $_SESSION['alert']['success'][] = 'Votre modification a bien été prise en compte';
                    header('location: /admin/users');
                    session_write_close();
                }
            else{
                //S'il y a des erreurs, on prépare leur affichage
                $_SESSION['alert']['danger'][] = $errors[0];
            }

        }
    }

    public function deleteUserAction() {
        //Instanciation de la classe User
        $user = new User();
        //Suppression d'un utilisateur grâce à son id
        if (!empty($_POST)) {
            if (!empty($_POST['deleteUser'])) {
                $user->delete($_POST['id_user']);
            }
        }
    }

}
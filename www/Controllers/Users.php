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
use App\Core\Helpers;



class Users{

    public function defaultAction(){

        $user = new User();
        $allUsers = $user->getAllUsers();

        $view = new View("User/users", "back");

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

        $view->assign('allUsers', Helpers::cleanArray($allUsers));
        $view->assign("statistics", $statisticsPages);

    }

    public function addUsersAction()
    {
        $security = Security::getInstance();
        if (!$security->isConnected()) {
            header('Location: /login');
        }

        $user = new User();
        $mailer = new Mailer();
        $bodymail = new BodyMail();

        $view = new View("User/add_users", "back");
        $token = rand(100000, 999999);

        $form = $user->buildFormUser();
        $view->assign("form", $form);

        if(!empty($_POST)){
            $view->assign("form", $form);
            $errors = Form::validator($_POST, $form);

            if(empty($errors)) {
                //S'il n'y a pas d'erreurs, on envoie les données dans la requête pour ajouter l'utilisateur
                //On vérifie si l'email a bien été renseigné
                if ($user->verifyEmail($_POST['email'])) {
                    $user->setFirstname($_POST['firstname']);
                    $user->setLastname($_POST['lastname']);
                    $user->setEmail($_POST['email']);
                    $user->setPhone($_POST['phone']);
                    $user->setRole($_POST['role']);
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

        $view = new View("User/newPasswordConfirm", "back_management");
        $user = new User();

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
                //On vérifie que le nouveau mot de passe et le mot de passe de confirmation sont égaux
                if(!$user->verifyPassword($_POST['password'], $_POST['password-confirm'])) {
                    $_SESSION['alert']['danger'][] = 'Les deux mots de passe ne correspondent pas';
                    header('location: /newpasswordconfirm');
                    session_write_close();
                } else {
                    //Si les mots de passe sont égaux, on enregistre le nouveau de passe dans la base de données avec une clé de chiffrement
                    $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT));
                    $user->setToken("");
                    $user->setIsVerified(1);
                    $user->save();
                    $_SESSION['alert']['success'][] = 'Votre mot de passe a bien été creé. Connectez-vous à votre compte';
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
        if(!$security->isConnected()){
            header('Location: /login');
        }

        $user = new User();
        $view = new View("User/edit_users", "back");
        $user->setId($_POST["id_user"]);

        $form = $user->buildFormUser();
        $view->assign("form", $form);

        if(!empty($_POST) && !empty($_POST['lastname'])){
            $errors = Form::validator($_POST, $form);
            if(empty($errors)) {
                //S'il n'y a pas d'erreurs, on envoie les données dans la requête pour ajouter l'utilisateur
                    $user->setFirstname($_POST['firstname']);
                    $user->setLastname($_POST['lastname']);
                    $user->setPhone($_POST['phone']);
                    $user->setUpdateDate(date ('Y-m-d H:i:s'));
                    $user->setRole($_POST['role']);

                    $user->save();

                    $_SESSION['alert']['success'][] = 'Votre modification a bien été prise en compte';
                    header('location: /admin/users');
                    session_write_close();
                }
            else{
                $_SESSION['alert']['danger'][] = $errors[0];
            }

        }
    }

    public function deleteUserAction() {
        $user = new User();
        if (!empty($_POST)) {
            if (!empty($_POST['deleteUser'])) {
                $user->delete($_POST['id_user']);
            }
        }
    }

}
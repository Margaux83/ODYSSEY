<?php

namespace App;

use App\Core\Security as coreSecurity;
use App\Core\Database;
use App\Core\View;
use App\Core\Form;
use App\Core\ConstantManager;
use App\Models\User;
use App\Core\FormBuilder;


class Security{


    public function defaultAction(){
        echo "controller security action default";
    }


    public function registerAction(){

        $coreSecurity = coreSecurity::getInstance();

        $user = new User();
        $view = new View("register", "back_management");

        $form = $user->buildFormRegister();
        $view->assign("form", $form);

        if(!empty($_POST)){
            $view->assign("form", $form);

            $errors = FormBuilder::validator($_POST, $form);
            if(empty($errors)){
                $user->setFirstname(htmlspecialchars(addslashes($_POST['firstname'])));
                $user->setLastname(htmlspecialchars(addslashes($_POST['lastname'])));
                $user->setEmail(htmlspecialchars(addslashes($_POST['email'])));
                $user->setPassword(htmlspecialchars(addslashes($_POST['password'])));
                $user->setPhone(htmlspecialchars(addslashes($_POST['phone'])));
                $user->setRole(1);
                $user->setIsDeleted(0);
                $user->save();

            }else{
                $view->assign("formErrors", $errors);
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

        $view = new View("login", "back_management");
    }

    public function logoutAction(){
        $coreSecurity = coreSecurity::getInstance();
        unset($_SESSION["userId"]);
        header('Location: /login');
    }

    public function listofusersAction(){

        $coreSecurity = coreSecurity::getInstance();
        if(!$coreSecurity->isConnected()){
            die("Error not authorized");
        }

        echo "Là je liste tous les utilisateurs";
    }

}

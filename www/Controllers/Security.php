<?php

namespace App;

use App\Core\Security as coreSecurity;
use App\Core\Database;
use App\Core\View;
use App\Core\Form;
use App\Core\ConstantManager;
use App\Models\User;

class Security{


    public function defaultAction(){
        echo "controller security action default";
    }


    public function registerAction(){

        $user = new User();
        $user->setId(1);
        $user->setFirstname("margaux");
        $user->save();

        /*
        $user = new User();
        $user->setId(3);
        $user->setLastname("Tutu");
         
            [id:App\Models\User:private] => 3 
            [firstname:protected] => Toto
            [lastname:protected] => Tutu 
            [email:protected] => y.skrzypczyk@gmail.com
            [pwd:protected] => Test1234
            [country:protected] => fr
            [status:protected] => 0 
            [role:protected] => 0 
>>>>>>> develop
            [isDeleted:protected] => 0
        */


        //$user->save();


        $user = new User();
        $view = new View("register", "front");
        $form = $user->buildFormRegister();
        $view->assign("form", $form);



        if(!empty($_POST)){
            $view->assign("form", $form);

            $errors = Form::validator($_POST, $form);

            if(empty($errors)){

                $user->setFirstname("Toto");
                $user->setLastname("Titi");
                $user->setEmail("y.skrzypczyk@gmail.com");
                $user->setPwd("Test1234");
                $user->setCountry("fr");
                //$user->save();

            }else{
                $view->assign("formErrors", $errors);
            }

        }
    }

    public function loginAction(){
        $coreSecurity = coreSecurity::getInstance();

        /* if ($coreSecurity->getConnectedUser()){
            header('Status: 400 Connected', true, 400);
            header('Location: /dashboard');
            return;
        }
        */
        $view = new View("login", "back_management");
    }

    public function logoutAction(){
        $coreSecurity = coreSecurity::getInstance();
        unset($_SESSION["userId"]);
        header('Location: /login');
    }

    public function listofusersAction(){

        $security = new coreSecurity();
        if(!$security->isConnected()){
            die("Error not authorized");
        }

        echo "Là je liste tous les utilisateurs";
    }

}

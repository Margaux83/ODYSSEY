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

        $coreSecurity = coreSecurity::getInstance();
        $view = new View("register", "back_management");

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

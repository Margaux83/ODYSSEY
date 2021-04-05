<?php

namespace App;

use App\Core\Security;
use App\Core\View;


class Users{


    public function defaultAction(){
        $view = new View("users", "back");


    }

    public function addUsersAction()
    {
        $view = new View("addUsers", "back");

    }


}
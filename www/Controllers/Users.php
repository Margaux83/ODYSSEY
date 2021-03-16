<?php

namespace App;

use App\Core\Security;
use App\Core\View;


class Users{


    public function defaultAction($menuData, $actualUri){
        $view = new View("users", "back", $menuData, $actualUri);


    }

    public function addUsersAction($menuData, $actualUri)
    {
        $view = new View("addUsers", "back", $menuData, $actualUri);

    }


}
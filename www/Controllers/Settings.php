<?php

namespace App;

use App\Core\Security;
use App\Core\View;

Class Settings{
    public function defaultAction(){
        $view = new View("settings", "back");
    }
}
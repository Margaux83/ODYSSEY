<?php

namespace App;

use App\Core\Security;
use App\Core\View;

Class Settings{
    public function defaultAction($menuData, $actualUri){
        $view = new View("settings", "back", $menuData, $actualUri);
    }
}
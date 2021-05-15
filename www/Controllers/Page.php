<?php

namespace App;

use App\Core\View;
use App\Models\User;
use App\Core\Form;

class Page{
    public function defaultAction(){
        $view = new View("pages", "back");
    }
}
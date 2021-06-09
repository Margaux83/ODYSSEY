<?php

namespace App;

use App\Core\View;
use App\Models\User;
use App\Core\Form;

class Page{
    public function defaultAction(){
        $view = new View("Page/pages", "back");
    }
    public function addPageAction(){
        $view = new View("Page/add_page", "back");
    }
}
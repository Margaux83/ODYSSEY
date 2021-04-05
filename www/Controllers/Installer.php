<?php

namespace App;

use App\Core\View;
use App\Models\User;
use App\Core\Form;

class Installer{
    public function setupAction(){
		$view = new View("installer", "back_management");
    }
}
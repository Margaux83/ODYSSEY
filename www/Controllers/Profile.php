<?php

namespace App;

use App\Core\Security;
use App\Core\View;
use App\Models\User;
use App\Core\Form;

class Profile
{
    public function defaultAction(){
        $security = Security::getInstance();
		if(!$security->isConnected()){
            header('Location: /login');
        }

		$view = new View("profile", "back");
        $user = new User();
        $user->setId($_SESSION['userId']);

        if(!empty($_POST)){
			$errors = Form::validator($_POST, $user->buildFormProfile());

			if(empty($errors)){
                $user->updateWithData($_POST);
                $user->save();
			}else{
				$view->assign("formErrors", $errors);
			}
		}
        
        $user->setId($_SESSION['userId']);
        $view->assign("connectedUser", $user);
		$view->assign("form", $user->buildFormProfile());

        $view->assign("role", $user->getRole());
    }
}
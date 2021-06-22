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
            $_SESSION['alert']['danger'][] = 'Veuillez vous connecter afin d\'accéder à cette page';
            header('Location: /login');
            exit;
        }

		$view = new View("profile", "back");
        $user = new User();
        $user->setId($_SESSION['userId']);

        if(!empty($_POST)){
			$errors = Form::validator($_POST, $user->buildFormProfile());

			if(empty($errors)){
                $user->updateWithData($_POST);
                $user->save();
                $_SESSION['alert']['success'][] = 'Modification du profil effectué avec succès !';
            }else{
				$view->assign("formErrors", $errors);
                $_SESSION['alert']['danger'][] = 'Erreur dans la modification du profil !';
            }
		}
        
        $user->setId($_SESSION['userId']);
        $view->assign("connectedUser", $user);
		$view->assign("form", $user->buildFormProfile());

        $view->assign("role", $user->getRole());
    }
}
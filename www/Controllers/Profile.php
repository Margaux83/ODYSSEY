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
                $_SESSION['alert']['success'][] = 'Modification du profil effectuée avec succès !';
            }else{
				$view->assign("formErrors", $errors);
                $_SESSION['alert']['danger'][] = 'Erreur dans la modification du profil !';
            }
		}
        
        $view->assign("connectedUser", $user);
		$view->assign("form", $user->buildFormProfile());
		$view->assign("formPassword", $user->buildFormPassword());

        $view->assign("role", $user->getRole());
    }


    public function changePasswordAction(){
        $user = new User();

        if(!empty($_POST)){
			$errors = Form::validator($_POST, $user->buildFormPassword());

			if(empty($errors)){

                if (
                    !empty($_POST['password'])
                    && !empty($_POST['new-password'])
                    && !empty($_POST['confirm-new-password'])
                ){
                    if ($_POST['new-password'] === $_POST['confirm-new-password']) {
                        $user->setId($_SESSION['userId']);
                        $result = $user->query(
                            ["password"],
                            ["id" => $_SESSION['userId']]
                        );

                        if (count($result) && password_verify($_POST['password'], $result[0]["password"])){
                            $user->setPassword(password_hash(htmlspecialchars(addslashes($_POST['new-password'])), PASSWORD_DEFAULT));
                            $user->save();

                            $_SESSION['alert']['success'][] = 'Modification du mot de passe effectuée avec succès !';
                        }else {
                            array_push($errors, 'Le mot de passe n\'a pas pu être modifié');
                        }
                    }else {
                        array_push($errors, 'Les nouveaux mots de passes doivent avoir la même valeur');
                    }
                }
            }
		}

        if(!empty($errors)){
            $_SESSION['alert']['danger'][] = implode($errors, '<br>');
        }
        header("Location: /admin/profile");
    }
}
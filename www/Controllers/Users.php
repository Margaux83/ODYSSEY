<?php

namespace App;

use App\Core\FormBuilder;
use App\Core\Security;
use App\Core\View;
use App\Models\User as User;


class Users{


    public function defaultAction(){
        $view = new View("users", "back");


    }

    public function addUsersAction()
    {
        $user = new User();
        $view = new View("addUsers", "back");

        $form = $user->buildFormRegisterU();
        $view->assign("form", $form);

        if(!empty($_POST)){
            $view->assign("form", $form);

            $errors = FormBuilder::validator($_POST, $form);

            if(empty($errors)){
                $user->setFirstname(htmlspecialchars(addslashes($_POST['firstname'])));
                $user->setLastname(htmlspecialchars(addslashes($_POST['lastname'])));
                $user->setEmail(htmlspecialchars(addslashes($_POST['email'])));
                $user->setPassword(htmlspecialchars(addslashes($_POST['password'])));
                $user->setPhone(htmlspecialchars(addslashes($_POST['phone'])));
                $user->setRole(1);
                $user->setIsDeleted(0);
                $user->save();

            }else{
                $view->assign("formErrors", $errors);
            }

        }

    }

    public function editUsersAction()
    {
        $user = new User();
        $view = new View("editUsers", "back");

        $form = $user->buildFormUpdate();
        $view->assign("form", $form);
    }


}
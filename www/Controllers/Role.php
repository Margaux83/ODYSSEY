<?php

namespace App;

use App\Core\View;
use App\Models\Role as ModelRole;
use App\Core\Database;
use App\Core\Helpers;

class Role
{

    /**
     * Display the list of registered and undeleted roles in the database
     */
    public function defaultAction()
    {
        $role = new ModelRole;
        $allRoles = $role->getAllRoles();

        $view = new View("Role/roles", "back");
        $view->assign("allRoles", Helpers::cleanArray($allRoles));
    }

    /**
     * Function to add a role and its permissions in the database
     * The different permissions are added in an array in a json format
     */
    public function addRoleAction()
    {
        $role = new ModelRole;

        if (!empty($_POST['values']) && !empty($_POST['name'])) {
            $role->setName($_POST['name']);
            $role->setValue(json_encode($_POST['values']));
            $role->save();
            $_SESSION['alert']['success'][] = "Le rôle a bien été ajouté !";
            header('location: /admin/roles');
            session_write_close();
        }

        $view = new View("Role/add_role", "back");
        $view->assign("rolesList", $role->rolesList());
        $view->assign("roleClass", $role);

    }

    /**
     * Function to edit a role and its permissions
     * The different permissions are added in an array in a json format
     * Retrieve and display the information of the role in the form thanks to the setId which takes in parameter the id of the role
     */
    public function editRoleAction()
    {
        // Edit Admin role forbidden
        if($_GET['role'] === "1" || $_GET['role'] === "4") header('location: /admin/roles');

        $role = new ModelRole;
        $actualRole = $_GET['role'];
        $role->setId($actualRole);
        $db = new Database("Role");
        $result = $db->query(
            ["name", "value"],
            ["id" => $actualRole]
        );
        if (!empty($_POST['values']) && !empty($_POST['name'])) {
            $role->setName($_POST['name']);
            $role->setValue(json_encode($_POST['values']));
            $role->save();
            $_SESSION['alert']['success'][] = "Le rôle a bien été modifié !";
            header('location: /admin/roles');
            session_write_close();
        }

        $view = new View("Role/add_role", "back");
        $view->assign("rolesList", $role->rolesList());
        $view->assign("roleClass", $role);
        $view->assign("roleResult", Helpers::cleanArray($result[0]));
    }

    /**
     * Deleting a role using its Id
     */
    public function deleteRoleAction() {
        $role = new ModelRole;
        if (!empty($_POST)) {
            if (!empty($_POST['deleteRole'])) {
                $role->delete($_POST['id_role']);
            }
        }
    }
}
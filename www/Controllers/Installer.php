<?php

namespace App;

use App\Core\View;
use App\Core\Installer as InstallerCore;
use App\Core\Routing;

/**
 * Class Installer
 * @package App
 * TODO : Mettre des commentaires d'explication
 */

class Installer{
    public function setupAction(){
        if(!empty($_POST)) {
            if(InstallerCore::checkDatabaseConnection()) {
                echo 'true';
            }
        } else {
            if(InstallerCore::checkIfInstallPossible()) {
                $view = new View("installer", "back_management");
            } else {
                header('location:' . Routing::getBaseUrl());
            }
        }

    }

    public function makeInstallAction() {
        $install = new InstallerCore();
        if(InstallerCore::checkIfInstallPossible() && InstallerCore::checkDatabaseConnection()) {
            InstallerCore::makeInstall();
            echo 'Install à faire -> ';
        } else {
            $_SESSION['alert']['danger'][] = 'Connexion à la base de données impossible';
            header('location:' . Routing::getBaseUrl());
            session_write_close();
        }
    }

    public function temporaryInstallAction() {
        $install = InstallerCore::makeDatabase();
        header('location: /admin/dashboard');
    }
}
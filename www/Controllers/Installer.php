<?php

namespace App;

use App\Core\View;
use App\Models\User;
use App\Core\Form;
use App\Core\Installer as InstallerCore;
use App\Core\Routing;


class Installer{
    public function setupAction(){
        if(InstallerCore::checkIfInstallPossible()) {
            $view = new View("installer", "back_management");
        } else {
            header('location:' . Routing::getBaseUrl());
        }
    }

    public function makeInstallAction() {
        $install = new InstallerCore();
        if(InstallerCore::checkIfInstallPossible()) {
            InstallerCore::makeInstall();
            echo 'Install à faire -> ';
        } else {
            header('location:' . Routing::getBaseUrl());
        }
    }
}
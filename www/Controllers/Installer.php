<?php

namespace App;

use App\Core\View;
use App\Models\User;
use App\Core\Form;
use App\Core\Installer as InstallerCore;


class Installer{
    public function setupAction(){
		$view = new View("installer", "back_management");
    }

    public function makeInstallAction() {
        $install = new InstallerCore();
        if(InstallerCore::checkIfInstallPossible()) {
            InstallerCore::makeInstall();
            echo 'Install à faire -> ';
        } else {
            echo 'Installation déjà installé';
        }
    }
}
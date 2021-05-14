<?php

namespace App;

use App\Core\Database;
use App\Core\Security;
use App\Core\View;

use App\Models\Settings as SettingsModel;

Class Settings extends Database{
    public function defaultAction(){
        $settings = new SettingsModel();
        $view = new View("settings", "back");

        $db = new Database("Config");
        $result = $db->query(
            ["options", "value"]
        );

        $form = $settings->buildFormConfig($result);
        $view->assign("form", $form);
    }
    public function editSettings() {

    }
}
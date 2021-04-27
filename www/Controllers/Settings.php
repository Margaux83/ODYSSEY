<?php

namespace App;

use App\Core\Database;
use App\Core\Security;
use App\Core\View;

use App\Models\Config as Config;

Class Settings{
    public function defaultAction(){
        $settings = new Config();
        $view = new View("settings", "back");

        $db = new Database("Config");
        $result = $db->query(
            ["Database_name", "Website_name", "URL_name", "Langue", "Timezone", "Server_name", "Port"]
        );

        $form = $settings->buildFormConfig($result);
        $view->assign("form", $form);
    }
}
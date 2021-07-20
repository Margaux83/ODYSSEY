<?php

namespace App\Core;

use App\Models\Config;

class Template
{
    public static function getSelectedTheme() {
        $config = new Config();
        $configResults = $config->query(['value'], ['options' => 'theme']);

        if (count($configResults)) {
            return $configResults[0]['value'];
        }else {
            return THEME;
        }
    }

    public static function changeSelectedTheme($newTheme) {
        $config = new Config();
        $config->setOptions('theme');
        $configResults = $config->query(['id', 'options', 'value'], ['options' => 'theme']);
        if (count($configResults)) {
            $config->setId($configResults[0]['id']);
        }
        $config->setValue($newTheme);
        $config->save();
        
        return true;
    }
}
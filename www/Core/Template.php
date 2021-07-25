<?php

namespace App\Core;

use App\Models\Config;

class Template
{
    /**
     * @return mixed
     */
    public static function getSelectedTheme() {
        $config = new Config();
        $configResults = $config->query(['value'], ['options' => 'theme']);

        if (count($configResults)) {
            return $configResults[0]['value'];
        }else {
            return THEME;
        }
    }

    /**
     * @param $newTheme
     * @return bool
     */
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

    /**
     * @param $uri
     * @return false|string
     */
    public static function searchPageSelectedTheme($uri) {
        $config = new Config();
        $configResults = $config->query(['value'], ['options' => 'theme']);

        if (count($configResults)) {
            $selectedTheme = $configResults[0]['value'];
        }else {
            $selectedTheme = THEME;
        }

        if (is_dir('./public/styles/themes/' . self::getSelectedTheme() . '/pages')) {
            foreach(scandir('./public/styles/themes/' . self::getSelectedTheme() . '/pages') as $key=> $founded) {
                if ($founded === trim($uri, '/') . '.php') {
                    return 'public/styles/themes/' . self::getSelectedTheme() . '/pages/' . $founded;
                }
            };
        }

        return false;
    }
}
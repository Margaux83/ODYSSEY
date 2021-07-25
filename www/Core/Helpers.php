<?php
namespace App\Core;

/**
 * Class Helpers
 * @package App\Core
 * Class that defines helper functions that can be used throughout the code
 */
class Helpers {

    public static function cleanFirstname($firstname) {
        return ucwords(mb_strtolower(trim($firstname)));
    }

    public static function error($param) {
        $_SESSION['alert']['danger'][] = $param;
    }

    //dump le parametre
    public static function debug($param) {
        echo '<pre>';
        print_r($param);
        echo '</pre>';
    }
}
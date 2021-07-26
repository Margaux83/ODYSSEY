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

    public static function debug($param) {
        echo '<pre>';
        print_r($param);
        echo '</pre>';
    }

    public function filter(&$value) {
        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    static function cleanArray($array) {
        array_walk_recursive($array, array(new Helpers() , 'filter'));
        return $array;
    }

    static function generateCsrfToken() {
        if (empty($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf'];
    }

    /**
     * @param $targetDirProp
     * @param $name
     * @return string
     */
    /*public static function uploadImage(string $targetDirProp, string $name)
    {
        if(!isset($_FILES[$name])) return null;
        $targetDir = $targetDirProp;
        $fileName = basename($_FILES[$name]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
        if ($fileType !== '') {
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES[$name]["tmp_name"], $targetFilePath)) {
                    $statusMsg = 'OK';
                } else {
                    $statusMsg = "Désolé, une erreur se produit.";
                }
            } else {
                $statusMsg = 'Format n\'est pas bon.';
            }

            return $statusMsg === 'OK' ? $targetFilePath : $statusMsg;
        } else {
            return null;
        }
    }*/
}
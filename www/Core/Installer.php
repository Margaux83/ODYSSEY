<?php
namespace App\Core;
use App\Core\Database;

class Installer {

    protected static $phpVersion = 7.2;
    protected static $query;

    public static function checkIfInstallPossible() {
        if(self::checkPhpVersion() && !self::checkIfEnvExist()) {
            return true;
        }
        return false;
    }

    public static function makeInstall() {
        // TODO Ecriture des fichiers d'environnement .env et .end.prod


        file_put_contents(".env.dist", "test");


        file_put_contents(".env.prod.dist", "qzdzqd");



        $query = self::getDatabaseQuery();
        $database = new Database();
        $install = $database->createDatabase($query);
        if($install > 0) {
            echo 'Install de la bdd faites';
        } else {
            echo 'Erreur dans l\'installation';
        }
    }

    public static function getDatabaseQuery() {
        return file_get_contents('odyssey.sql');
    }

    public static function checkPhpVersion() {
        if(version_compare(phpversion(), self::$phpVersion, ">=")) {
            return true;
        }
        return false;
    }

    public static function checkIfEnvExist() {
        if(file_exists('.env') || file_exists('.env.dev') || file_exists('.env.prod')) {
            return true;
        }
        return false;
    }
}
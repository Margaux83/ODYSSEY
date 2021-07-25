<?php
namespace App\Core;
use App\Core\Database;
use App\Models\User;

class Installer {

    protected static $phpVersion = 7.2;
    protected static $query;

    public static function checkIfInstallPossible() {
        if(self::checkPhpVersion() && !self::checkIfEnvExist()) {
            // A inverser checkIfEnvExist
            return true;
        }
        return false;
    }

    public static function makeInstall() {
        // TODO Ecriture des fichiers d'environnement .env et .end.prod
        echo '<pre>';
        var_dump($_POST);
        self::writeEnvFiles($_POST['config'], $_POST['database']);
        new ConstantManager();
        $install = self::makeDatabase();

        if($install > 0) {
            echo 'Install de la bdd faites';
            self::createFirstUser($_POST['user']);
            $_SESSION['alert']['danger'][] = 'GG';
            header('location: /login');
            session_write_close();
        } else {
            header('location: /installer');
            session_write_close();
        }
    }

    public static function makeDatabase() {
        $query = self::getDatabaseQuery();
        $database = new Database();
        $install = $database->createDatabase($query);
        var_dump($install);
        return $install;
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

    public static function checkDatabaseConnection() {
        try {
            $conn = new \PDO(
                "mysql:dbname=" . $_POST['database']['dbname'] . ";host=" . $_POST['database']['dbhost'],
                $_POST['database']['dbuser'],
                $_POST['database']['dbpwd']);
            return true;
        } catch(\PDOException $ex) {
            return false;
        }
    }

    public static function checkIfDatabaseExist() {
        var_dump($_POST['database']);

        exit(0);
        return false;

    }

    public static function writeEnvFiles($config, $database) {
        $env = ".env";
        $envprod = ".env.prod";
        self::putOnEnvFile($env);
        self::putOnEnvProdFile($envprod, $database, $config);
    }

    public static function putOnEnvFile($env) {
        $content_env = "ENV=prod";
        file_put_contents($env, $content_env);
    }

    public static function putOnEnvProdFile($envprod, $database, $config) {
        $content_envprod = "";
        foreach($database as $key => $value){
            echo $key." - ".$value.'<br>';
            $content_envprod .= strtoupper($key) . "=" . $value . PHP_EOL;
        }
        $content_envprod .= "DBDRIVER=mysql" . PHP_EOL;
        foreach($config as $key => $value){
            echo $key." - ".$value.'<br>';
            $content_envprod .= strtoupper($key) . "=" . $value . PHP_EOL;
        }
        $content_envprod .= "MAILUSER=cockpit.website@gmail.com" . PHP_EOL;
        $content_envprod .= "MAILPWD=admin73019" . PHP_EOL;

        file_put_contents($envprod, $content_envprod);
    }

    public static function createFirstUser($user_info) {
        $user = new User();
        $user->setFirstname($user_info['userAdminFirstName']);
        $user->setLastname($user_info['userAdminLastName']);
        $user->setEmail($user_info['userAdminEmail']);
        $user->setPassword(password_hash($user_info['userAdminPwd'], PASSWORD_BCRYPT));
        $user->setPhone("0659737458");
        $user->setRole("1");
        $user->setIsDeleted(0);
        $user->setToken("");
        $user->setIsVerified(1);
        $user->save();
    }
}
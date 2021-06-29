<?php

namespace App\Core;

use App\Core\CurrentUser;
use App\Core\Database;
use App\Models\Role;
use App\Models\User;

class Security
{
	private static $_instance = null;
    private static $_userConnectedId = null;
    private static $_actualUri;

	private function __construct($_userConnectedId) {
        self::$_userConnectedId = $_userConnectedId;
    }

    public static function getInstance($_userConnectedId = null) {
        if(is_null(self::$_instance)) {
			session_start();
            self::$_instance = new Security($_userConnectedId);  
        }

        return self::$_instance;
    }

    public static function isAuthorized($uri) {
        self::$_actualUri = $uri;
        $user = new User();
        $role = new Role();
        $db = new Database("Role");
        $result = $db->query(
            ["value"],
            ["id" => $user->getRole()]
        );
        $perms = json_decode($result[0]['value'], true);
        if (array_key_exists($uri, $perms) || array_key_exists("all_perms", $perms) || $uri == "/dashboard") {
            // TODO Redirection à faire autre part que /dashboard
            return true;
        }
        return false;
    }

	public function isConnected(){
		return isset($_SESSION["userId"]);
	}

	public function getConnectedUser(){
		if ($this->isConnected()){
            $_SESSION['alert']['danger'][] = 'Vous êtes déjà connecté';
            return true;
		}

		if (!isset($_POST['login-email']) || !isset($_POST['login-pwd'])){
            return;
		}

		$emailUserLogin = htmlspecialchars(addslashes($_POST['login-email']));
		$pwdUserLogin = htmlspecialchars(addslashes($_POST['login-pwd']));

		$db = new Database("User");
		$result = $db->query(
			["id", "password", "isVerified"],
			["email" => $emailUserLogin]
		);

		if (count($result) && password_verify($pwdUserLogin, $result[0]["password"])){
		    if($result[0]["isVerified"] == "1") {
                    $_SESSION["userId"] = $result[0]["id"];
                    $_SESSION['alert']['success'][] = 'Vous êtes désormais connecté';
                    return true;
            } else {
                $_SESSION['alert']['danger'][] = 'Veuillez valider votre compte avec votre adresse mail';
            }
		} else {
            $_SESSION['alert']['danger'][] = 'Les informations de connexions sont incorrects';
        }
		return false;
	}
}
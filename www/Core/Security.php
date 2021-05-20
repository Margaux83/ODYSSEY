<?php

namespace App\Core;

use App\Core\CurrentUser;
use App\Core\Database;

class Security
{
	private static $_instance = null;
    private static $_userConnectedId = null;

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

	public function isConnected(){
		return isset($_SESSION["userId"]);
	}

	public function getConnectedUser(){
		if ($this->isConnected()){
			var_dump("already connected");
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

		if (count($result)){
		    if($result[0]["isVerified"] == "1") {
                if (password_verify($pwdUserLogin, $result[0]["password"])){
                    $_SESSION["userId"] = $result[0]["id"];
                    return true;
                }
            }
		}
		return false;
	}
}
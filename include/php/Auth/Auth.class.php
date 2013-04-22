<?php

session_start();

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Database/Database.class.php");

class Auth {
	
	public static function CheckUser($username, $password) {
		
		$password = sha1($password);
		
		$user = Database::Query("SELECT * FROM users WHERE username = ? AND password = ?", "ss", $username, $password);
		
		if(count($user) == 1) {
			
			$_SESSION["username"] = $user[0]["username"];
			$_SESSION["user_id"] = $user[0]["id"];
			
			return true;
			
		}
		else {
			
			return false;
			
		}
		
		
	}
	
	public static function Logout() {
		
		session_unset();
		
	}
	
	public static function IsLoggedIn() {
		
		return isset($_SESSION["username"]);
		
	}
	
}

?>
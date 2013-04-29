<?php

session_start();

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Database/Database.class.php");

/* Class to handle user authentication */
class Auth {
	
	/* Check whether the users credentials are valid */
	public static function CheckUser($username, $password) {
		
		/* Hash password */
		$password = sha1($password);
		
		$user = Database::Query("SELECT * FROM users WHERE username = ? AND password = ?", "ss", $username, $password);
		
		/* If the query returns 1 row, the credentials matched a user */
		if(count($user) == 1) {
			
			/* Set session variables */
			$_SESSION["username"] = $user[0]["username"];
			$_SESSION["user_id"] = $user[0]["id"];
			
			return true;
			
		}
		/* No matches, or multiple matches, invalid credentials */
		else {
			
			return false;
			
		}
		
		
	}
	
	/* Destroy session */
	public static function Logout() {
		
		session_unset();
		
	}
	
	/* Returns true if there is a currently active session, and a user is logged in */
	public static function IsLoggedIn() {
		
		return isset($_SESSION["username"]);
		
	}
	
}

?>
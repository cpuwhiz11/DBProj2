<?php

	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Auth/Auth.class.php");
	
	/* Destroy session */
	Auth::Logout();
	
	/* Redirect to home page, login is required so the login page will end up being displayed */
	header("location: /");

?>

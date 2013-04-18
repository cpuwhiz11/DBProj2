<?php

	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Auth/Auth.class.php");
	
	Auth::Logout();
	
	header("location: /");

?>

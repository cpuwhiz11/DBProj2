<?php

	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Auth/Auth.class.php");

	if(Auth::CheckUser($_POST["username"], $_POST["password"])) {
		
		echo "1";
		
	}
	else {
		
		echo "0";
		
	}
	
?>

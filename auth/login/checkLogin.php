<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Auth/Auth.class.php");

/* Valdid login */
if(Auth::CheckUser($_POST["username"], $_POST["password"])) {

	echo "1";

}
/* Invalid login */
else {

	echo "0";

}
	
?>

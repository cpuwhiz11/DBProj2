<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/User/User.class.php");

/* Create order */
User::MakeOrder($_SESSION["user_id"], $_POST["shipping_address"], $_POST["total"], $_POST["tax"], $_POST["shipping"]);

?>
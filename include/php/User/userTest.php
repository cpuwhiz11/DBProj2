<?php

require_once("User.class.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Cart/Cart.class.php");

Cart::AddToCart(3, "9781558155091", 3);
Cart::AddToCart(3, "9781558155091", 2);

User::MakeOrder(3, "5 BEAT ROAD",
	            30, 5, 5);

?>

<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Cart/Cart.class.php");

Cart::RemoveFromCart($_SESSION["user_id"], $_POST["isbn"]);

$data = array(
			"cart_quantity" => Cart::GetNumberItemsInCart($_SESSION["user_id"]),
			"cart_total" => Cart::GetCartTotal($_SESSION["user_id"])
		);

echo json_encode($data);

?>
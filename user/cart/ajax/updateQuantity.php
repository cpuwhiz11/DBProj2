<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Cart/Cart.class.php");

/* Update the quantity of book in the cart */
Cart::UpdateQuantity($_SESSION["user_id"], $_POST["isbn"], $_POST["quantity"]);

/* Build json string containing the number of items in the cart and the cart total */
$data = array(
			"cart_quantity" => Cart::GetNumberItemsInCart($_SESSION["user_id"]),
			"cart_total" => Cart::GetCartTotal($_SESSION["user_id"])
		);

echo json_encode($data);

?>
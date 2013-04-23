<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Cart/Cart.class.php");

Cart::AddToCart($_SESSION["user_id"], $_POST["isbn"], $_POST["quantity"]);

echo Cart::GetNumberItemsInCart($_SESSION["user_id"]);

?>

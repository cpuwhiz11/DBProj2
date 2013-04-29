<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Cart/Cart.class.php");

/* Add book to cart */
Cart::AddToCart($_SESSION["user_id"], $_POST["isbn"], $_POST["quantity"]);

/* Returns the number of items in the users cart so cart count can be updated on the page */
echo Cart::GetNumberItemsInCart($_SESSION["user_id"]);

?>

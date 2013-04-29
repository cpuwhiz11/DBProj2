<?php 
	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Auth/Auth.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Cart/Cart.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/User/User.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Search/Search.class.php");
	
	if(!Auth::IsLoggedIn()) { header("location: /auth/login/"); }
	
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="/include/css/default.css" rel="stylesheet" type="text/css"/>
		<script src="/include/js/jQuery.js"></script>
        <title>Shopping Cart</title>
		<script>
			
			$(document).ready(function() {
				
				$("#search_field").focus();
				
				/* Update the quantity of a book */
				$(".update_quantity").click(function() {
										
					$.post("ajax/updateQuantity.php", 
						{
							isbn: $(this).attr("data-id"),
							quantity: $(this).closest("div").find(".quantity_input").val()
						},
						function(data) {
							var json = jQuery.parseJSON(data);
							
							$("#total_price").html("Total: $" + json.cart_total);
							$(".shopping_cart_link").html("Cart (" + json.cart_quantity + ")");
							
						}
					);
					
				});
				
				/* Remove book from cart */
				$(".remove_from_cart").click(function() {
					
					$.post("ajax/removeFromCart.php",
						{
							isbn: $(this).attr("data-id")
						},
						function(data) {
							var json = jQuery.parseJSON(data);
							
							$("#total_price").html("Total: $" + json.cart_total);
							$(".shopping_cart_link").html("Cart (" + json.cart_quantity + ")");
																					
						}
					);
					
					/* Remove book from page */
					$(this).closest("div").remove();
					
					/* Cart is now empty, display the empty cart message */
					if($(".cart_item").length == 0) {
						
						$("#cart_summary").remove();
						
						var emptyCart = $("<div class=\"empty_cart\"><h2>Your cart is empty!</h2></div>");
						
						$("#content").append(emptyCart);
						
					}
					
				});
				
			});
			
		</script>
    </head>
    <body>
		
		<nav>
			<div id="logo">
				<a href="/"><img src="/include/img/booksrus_logo_250.png"/></a>
			</div>
			
			<div id="search">
				<form action="/search/" method="get">
					<div id="seach_in_select">
						<select name="c">
							<option value="title">Title</option>
							<option value="author">Author</option>
							<option value="keyword">Keyword</option>
							<option value="category">Category</option>							
						</select>
					</div>
					<div id="search_box">
						<input type="text" name="s" id="search_field" />
					</div>
					<div id="submit_button">
						<input type="submit" value="Go"/>
					</div>
				</form>
			</div>
			
			<div id="user">
				Hello, <a href="/user/"><?php echo $_SESSION["username"]; ?></a>.
				<a href="/user/cart/" class="shopping_cart_link">Cart (<?php echo Cart::GetNumberItemsInCart($_SESSION["user_id"]); ?>)</a>
				<a href="/auth/logout/" class="logout_link"></a>
			</div>
						
		</nav>
		
		<div id="content">
			
			<?php 
			
				$cartContents = Cart::GetCart($_SESSION["user_id"]);
											
				if(count($cartContents) > 0) {
					foreach($cartContents as $book) {
						
						?>
			
							<div class="cart_item">
				
								<h1><?php echo $book["title"]; ?></h1>
								
								<a class="update_quantity" data-id="<?php echo $book["book_id"]; ?>" href="javascript:void(0)">Update</a>
								
								<input class="quantity_input" type="text" value="<?php echo $book["quantity"]; ?>"/> 
								
								<span class="price">$<?php echo $book["price"]; ?></span>
								
								<a class="button button_red remove_from_cart" data-id="<?php echo $book["book_id"]; ?>" href="javascript:void(0)">Remove</a>
								
							</div>
			
						<?php

					}
					
					?>
			
						<div id="cart_summary">
							
							<span id="total_price">Total: $<?php echo Cart::GetCartTotal($_SESSION["user_id"]); ?></span>
							
							<a class="button button_green" id="checkout" href="checkout/">Checkout</a> 
						
						</div>
			
					<?php
					
					
				}
				else {
				
					?>
						<div class="empty_cart">
							<h2>Your cart is empty!</h2>
						</div>
					<?php
				
				}
				
			?>
			
			
			
			
		</div>
		
</html>

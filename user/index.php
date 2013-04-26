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
        <title>Database Project 2</title>
		<script>
			
			$(document).ready(function() {
				
				$("#search_field").focus();
				
			});
			
		</script>
    </head>
    <body>
		
		<nav>
			<div id="logo">
				<img src="/include/img/booksrus_logo_250.png"/>
			</div>
			
			<div id="search">
				<form action="search/" method="get">
					<div id="seach_in_select">
						<select name="c">
							<option value="title">Title</option>
							<option value="author">Author</option>
							<option value="publishers">Publishers</option>
							<option value="keyword">Keyword</option>
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
			
			<!-- put content in this div -->

			<?php 
			       echo "Past Orders <br><br>";
				$pastOrders = User::GetOrderHistory($_SESSION["user_id"]);
				
				//echo "<pre>";
				//print_r($pastOrders);
				//echo "</pre>";

				if(count($pastOrders) > 0) {
					foreach($pastOrders as $order) {
     			              ?>
                                       <div class = "order">
                                       <span class="book_prices"><?php echo "Price of Books: $" . strval($order[total_price] - $order[tax] - $order[shipping]); ?></span>
                                       <span class="book_tax"><?php echo "Tax: $" . strval($order[tax]); ?></span>
                                       <span class="book_shipping"><?php echo "Shipping: $" . strval($order[shipping]); ?></span>
                                       <span class="book_total"><?php echo "Total Price: $" . strval($order[total_price]); ?></span>
                                       <span class="book_shipped"><?php echo "Shipped to: " . strval($order[shipping_address]); ?></span>
                                       <a href="orders/?id=<?php echo $order[id]; ?>"><order id>See What Books You Ordered</a>
                                       </div>
			
					<?php

					}
				}
				else {
				
					?>
			
					<p>You have no past order!</p>
					
					<?php
				
				}
				
			?>
		
		</div>
		
</html>

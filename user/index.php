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
				<form action="/search/" method="get">
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
			
			<div id="order_history">
				
				<h1 class="order_history_heading">Past Orders</h1>

				<?php 

					$pastOrders = User::GetOrderHistory($_SESSION["user_id"]);
					
					if(count($pastOrders) > 0) {

						foreach($pastOrders as $order) {

							?>

								<div class="order">
									<h1><?php echo "Order: " . str_pad($order["id"], 4, "0", STR_PAD_LEFT); ?></h1>
									
									<table class="price_summary">
										<tr>
											<td>Price of books:</td>
											<td><?php echo "$" . number_format($order[total_price] - $order[tax] - $order[shipping], 2); ?></td>
										</tr>
										<tr>
											<td>Tax:</td>
											<td><?php echo "$" . number_format($order[tax], 2); ?></td>
										</tr>
										<tr>
											<td>Shipping:</td>
											<td><?php echo "$" . number_format($order[shipping], 2); ?></td>
										</tr>
										<tr>
											<td>Total:</td>
											<td><?php echo "$" . number_format($order[total_price], 2); ?></td>
										</tr>
									</table>
									
									<a class="order_contents_link" href="orders/?id=<?php echo $order[id]; ?>">See What Books You Ordered</a>
									
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
							
		</div>
		
</html>

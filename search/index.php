<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Auth/Auth.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Cart/Cart.class.php");
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
				
				$(".add_to_cart").click(function() {
					
					console.log($(this).attr("data-id"));
					
					$.post("ajax/addToCart.php",
						{ 
							isbn: $(this).attr("data-id"),
							quantity: $(this).closest("div").find(".quantity").val()
						},
						function(data) {
							console.log(data);
						}
					);
					
				});
				
			});
		</script>
    </head>
    <body>
		<div id="top_bar">
			<div id="user">
				<a href="/user/cart/" class="shopping_cart_link"></a><p id="cart_quantity">(<?php echo Cart::GetNumberItemsInCart($_SESSION["user_id"]); ?>)</p>
				<a href="/user/"><?php echo $_SESSION["username"]; ?></a>
				<a href="/auth/logout/" class="logout_link"></a>
			</div>
		</div>
		<div id="content">
			<?php
			
				$books = Search::GetBooks($_GET["c"], $_GET["s"]);
				
				if(count($books) > 0) {
					foreach($books as $book) {
						
						?>
							
							<div class="book_entry">
								
								<?php //print_r($book); ?>
								
								<h1><?php echo $book["title"] . " by " . $book["author"] . " (" . date("M d, Y", strtotime($book["published"])) . ")"; ?></h1>
								
								
								<select class="quantity">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
								</select>
								<a class="button add_to_cart" data-id="<?php echo $book["isbn"]; ?>" href="javascript:void(0)">Add to Cart</a>
																
							</div>
			
						<?php

					}
				}
				else {
					
					?>
			
						<div class="no_books">
				
							<p>No books found!</p>
							
						</div>
			
					<?php
				}
			
			?>
		</div>
    </body>
</html>

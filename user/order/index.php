<?php 
	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Auth/Auth.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Book/Book.class.php");
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
		<script src="/include/js/raty/jquery.raty.js"></script>
        <title>Database Project 2</title>
		<script>
			
			$(document).ready(function() {
				
				$("#search_field").focus();
				
				$(".star").raty({
				score: function() {
					return $(this).attr('data-score');
				},
				click: function(score, evt) {
					
					$.post("ajax/updateStars.php",
						{
							isbn: $(this).attr("data-isbn"),
							stars: score
						},
						function(data) {
							
							console.log(data);
							
						}
					);
					
				}
			});
				
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
		
			<div id="order_contents">
				
				<h1 class="order_contents_heading">Books in this order</h1>
				
				<?php
                
					$pastOrders = User::GetOrderBooks($_GET["id"]);

					if(count($pastOrders) > 0) {
						
						foreach($pastOrders as $book) {
							
						?>
				
							<div class="book_entry">
																
								<h1><?php echo Book::TruncateTitle($book["title"]) . " by " . $book["author"] . " (" . date("M d, Y", strtotime($book["published"])) . ")"; ?></h1>
								
																
								<div class="star" data-isbn="<?php echo $book["isbn"]; ?>" data-score="<?php echo ($book["stars"] / $book["ratings"]); ?>"></div>
																
								<span class="isbn">ISBN: <?php echo $book["isbn"]; ?></span>
								<span class="published">Pusblished: <?php echo date("n/j/Y", strtotime($book["published"])); ?></span>
								<span class="category">Category: <?php echo $book["category"]; ?></span>
								<span class="length">Length: <?php echo $book["length"]; ?> pages</span>
								<span class="price"><?php echo "$" . $book["price"]; ?></span>
																								
							</div>

						<?php

						}
					}
					else {

						?>

							<p>Strange, no books here!</p>

						<?php

					}

				?>
			
			</div>
		
		</div>
		
</html>

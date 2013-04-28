<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Auth/Auth.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Book/Book.class.php");
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
		<script src="/include/js/raty/jquery.raty.js"></script>
        <title>Database Project 2</title>
		<script>
			$(document).ready(function() {
				
				$(".add_to_cart").click(function() {
										
					$.post("ajax/addToCart.php",
						{ 
							isbn: $(this).attr("data-id"),
							quantity: $(this).closest("div").find(".quantity").val()
						},
						function(data) {
							console.log(data);
							
							$(".shopping_cart_link").html("Cart (" + data + ")");
						}
					);
					
				});
							
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
			<?php
			
				$books = Search::GetBooks($_GET["c"], $_GET["s"]);
				
				if(count($books) > 0) {
					foreach($books as $book) {
						
						?>
							
							<div class="book_entry">
								
								<?php //print_r($book); ?>
								
								<h1><?php echo Book::TruncateTitle($book["title"]) . " by " . $book["author"] . " (" . date("M d, Y", strtotime($book["published"])) . ")"; ?></h1>
								
								
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
								
								<div class="star" data-isbn="<?php echo $book["isbn"]; ?>" data-score="<?php echo ($book["stars"] / $book["ratings"]); ?>"></div>
																
								<span class="isbn">ISBN: <?php echo $book["isbn"]; ?></span>
								<span class="published">Pusblished: <?php echo date("n/j/Y", strtotime($book["published"])); ?></span>
								<span class="category">Category: <?php echo $book["category"]; ?></span>
								<span class="length">Length: <?php echo $book["length"]; ?> pages</span>
								<span class="price"><?php echo "$" . $book["price"]; ?></span>
								
								<a class="button button_blue add_to_cart" data-id="<?php echo $book["isbn"]; ?>" href="javascript:void(0)">Add to Cart</a>
																
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

<?php 
	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Auth/Auth.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Cart/Cart.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Search/Search.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Home/Home.class.php");
	
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
		<div id = "topBooks">
              
			<div class="top_rated">
				
				<h1>Top Rated Books</h1>
				
				<ol class = "popular_books">

				<?php 

					$highestRatedBooks = Home::HighestRatedBooks();

					foreach($highestRatedBooks as $book) {

						?>

							<li class="book"><?php echo $book[title]; ?></li>

						<?php
					} 

				?>

				</ol>
			</div>
                
			
				
			<div class="most_rated">
				
				<h1>Most Rated Books</h1>
				
				<ol class = "popular_books">

				<?php


					$mostRated = Home::MostRatedBooks(); 

					foreach($mostRated as $book) {

					  ?>

						  <li><?php echo $book[title]; ?></li>

					  <?php

					} 

				?>

				</ol>
			</div>
		</div>

</html>

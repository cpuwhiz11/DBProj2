<?php 
	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Auth/Auth.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Search/Search.class.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="/include/css/default.css" rel="stylesheet" type="text/css"/>
		<script src="/include/js/jQuery.js"></script>
        <title>Database Project 2</title>
    </head>
    <body>
		<div id="top_bar">
			<div id="user">
				<?php

					if(Auth::IsLoggedIn()) {
						?>
							<a href="/user/cart/" class="shopping_cart_link"></a>(3)
							<a href="/user/"><?php echo $_SESSION["username"]; ?></a>
							<a href="/auth/logout/" class="logout_link"></a>
						<?php
					}
					else {
						?>
							<a href="/auth/login/"><img src="/include/img/login_white_20.png" alt="login"/></a>
						<?php
					}

				?>
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

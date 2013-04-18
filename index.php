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
		<script>
			
			$(document).ready(function() {
				
				$("#search_field").focus();
				
			});
			
		</script>
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
		<div id="search_box">
			<form action="search/" method="get">
				<select name="c">
					<option value="title">Title</option>
					<option value="author">Author</option>
					<option value="publishers">Publishers</option>
					<option value="keyword">Keyword</option>
				</select>
				<input type="text" name="s" id="search_field" /><input type="submit" value="Search"/>
			</form>
		</div>
    </body>
</html>

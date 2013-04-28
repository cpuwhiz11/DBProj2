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
						
					$(this).closest("div").remove();
					
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
                  <form>
                      Street Name: <input type="text" name="streetName"><br>
                      City: <input type="text" name="cityName"><br>
                      State: <select name="state"><br>
	                     <option value="AL">Alabama</option>
				<option value="AK">Alaska</option>
				<option value="AZ">Arizona</option>
				<option value="AR">Arkansas</option>
				<option value="CA">California</option>
				<option value="CO">Colorado</option>
				<option value="CT">Connecticut</option>
				<option value="DE">Delaware</option>
				<option value="DC">District of Columbia</option>
				<option value="FL">Florida</option>
				<option value="GA">Georgia</option>
				<option value="HI">Hawaii</option>
				<option value="ID">Idaho</option>
				<option value="IL">Illinois</option>
				<option value="IN">Indiana</option>
				<option value="IA">Iowa</option>
				<option value="KS">Kansas</option>
				<option value="KY">Kentucky</option>
				<option value="LA">Louisiana</option>
				<option value="ME">Maine</option>
				<option value="MD">Maryland</option>
				<option value="MA">Massachusetts</option>
				<option value="MI">Michigan</option>
				<option value="MN">Minnesota</option>
				<option value="MS">Mississippi</option>
				<option value="MO">Missouri</option>
				<option value="MT">Montana</option>
				<option value="NE">Nebraska</option>
				<option value="NV">Nevada</option>
				<option value="NH">New Hampshire</option>
				<option value="NJ">New Jersey</option>
				<option value="NM">New Mexico</option>
				<option value="NY">New York</option>
				<option value="NC">North Carolina</option>
				<option value="ND">North Dakota</option>
				<option value="OH">Ohio</option>
				<option value="OK">Oklahoma</option>
				<option value="OR">Oregon</option>
				<option value="PA">Pennsylvania</option>
				<option value="RI">Rhode Island</option>
				<option value="SC">South Carolina</option>
				<option value="SD">South Dakota</option>
				<option value="TN">Tennessee</option>
				<option value="TX">Texas</option>
				<option value="UT">Utah</option>
				<option value="VT">Vermont</option>
				<option value="VA">Virginia</option>
				<option value="WA">Washington</option>
				<option value="WV">West Virginia</option>
				<option value="WI">Wisconsin</option>
				<option value="WY">Wyoming</option>
                      </select>
                      Zip Code: <input type="text" name="zipCode"><br>
                  </form>

			
		</div>
		
</html>

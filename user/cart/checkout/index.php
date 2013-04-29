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
				
				$("#place_order").click(function() {
					
					var name		= $("#name").val();
					var streetName	= $("#streetName").val();
					var cityName	= $("#cityName").val();
					var state		= $("#state").val();
					var zipCode		= $("#zipCode").val();
					var tax			= $("#tax").html().replace("$", "");
					var shipping	= $("#shipping").html().replace("$", "");
					var total		= $("#total").html().replace("$", "");
					
					/* Concatenate all the shipping information into an address */
					var address = name + " " + streetName + " " + cityName + " " + state + " " + zipCode;
							
			    	/* Check that the fields are valid */
				    if (name.length == 0)
				    {
					  alert("You must enter a name.");
					  return false; 
				    }
				    if (streetName.length == 0)
				    {
					  alert("You must enter a stree name.");
					  return false; 
				    }
				    if (cityName.length == 0)
				    {
					  alert("You must enter a city name");
					  return false; 
				    }
				    if (zipCode.length == 0 || zipCode.length < 5)
				    {
					  alert("You must enter a valid zip code.");
					  return false; 
				    }
							
					/* Create order */
					$.post("ajax/placeOrder.php",
						{
							shipping_address: address,
							tax: tax,
							shipping: shipping,
							total: total
						},
						function(data) {
							
							$("#checkout_form").fadeOut(500);
							$("#order_confirmation").fadeIn(300);
							
						}
					);
					
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
			
			<div id="checkout_form">
				
				<?php
				
					$tax = number_format(Cart::GetCartTotal($_SESSION["user_id"]) * .0625, 2);
					$shipping = number_format(rand(5, 20), 2);
					$total = Cart::GetCartTotal($_SESSION["user_id"]) + $tax + $shipping;
				
				?>
				
				<h1>Order Information</h1>
			
				<table>
					<tr>
						<td>Name:</td>
						<td><input type="text" id="name"></td>
					</tr>
					<tr>
						<td>Street Name:</td>
						<td><input type="text" id="streetName"></td>
					</tr>
					<tr>
						<td>City:</td>
						<td><input type="text" id="cityName"></td>
					</tr>
					<tr>
						<td>State:</td>
						<td>
							<select id="state"><br>
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
						</td>
					</tr>
					<tr>
						<td>Zip Code:</td>
						<td><input type="text" id="zipCode"></td>
					</tr>
					<tr>
						<td>Tax:</td>
						<td id="tax"><?php echo "$" . $tax; ?></td>
					</tr>
					<tr>
						<td>Shipping:</td>
						<td id="shipping"><?php echo "$" . $shipping; ?></td>
					</tr>
					<tr>
						<td>Total:</td>
						<td id="total"><?php echo "$" . $total; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><a class="button button_green" id="place_order" href="javascript:void(0)">Place order!</a>
					</tr>
				</table>

			</div>
			
			<div id="order_confirmation">
				
				<h1>Thank you for your order!</h1>
				
			</div>
			
		</div>
		
</html>

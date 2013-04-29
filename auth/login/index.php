<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="/include/css/default.css" rel="stylesheet" type="text/css"/>
		<script src="/include/js/jQuery.js"></script>
        <title>Login</title>
		<script>
			/* Calls checklogin.php which returns wether the login was valid or not */
			function login() {
				
				var username = $("#username").val();
				var password = $("#password").val();

				/* Password and username must be valid strings, otherwise it is automatically invalid */
				if(username.length > 0 && password.length > 0) {

					/* Send credentials to checklogin.php which returns 0 or 1 for invalid or valid login */
					$.post("checkLogin.php",
						{
							username: username,
							password: password
						},
						function(data) {
							/* Valid login, redirect to home page */
							if(parseInt(data) == 1) {
								window.location = "/";
							}
							/* Invalid login, display error in box */
							else {
								$("#status").text("The credentials you have entered are invalid.");
							}
						}
					);

				}
				/* Invalid login, nothing entered in box */
				else {
					$("#status").text("The credentials you have entered are invalid.");
				}
				
			}
			
			$(document).ready(function() {
				
				/* Set the username field to be focused on page load */
				$("#username").focus();
				
				/* Call login function when the login button is clicked */
				$("#login").on("click", function() {
					
					login();
					
				});
				
				/* Call login upon pressing return on the password field */
				$("#login_box input").keypress(function (e) {
					if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
						login();
					}
				});
				
			});
			
			
		</script>
    </head>
    <body>
		<div id="login_box">
			<div><input type="text" id="username" placeholder="Username"/></div>
			<div><input type="password" id="password" placeholder="Password"/></div>
			<div id="login_post"><p id="status"></p><button type="button" id="login">Login</button></div>
		</div>
    </body>
</html>

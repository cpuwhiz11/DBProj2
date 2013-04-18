<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="/include/css/default.css" rel="stylesheet" type="text/css"/>
		<script src="/include/js/jQuery.js"></script>
        <title>Login</title>
		<script>
			function login() {
				
				var username = $("#username").val();
				var password = $("#password").val();

				if(username.length > 0 && password.length > 0) {

					$.post("checkLogin.php",
						{
							username: username,
							password: password
						},
						function(data) {
							if(parseInt(data) == 1) {
								window.location = "/";
							}
							else {
								$("#status").text("The credentials you have entered are invalid.");
							}
						}
					);

				}
				else {
					$("#status").text("The credentials you have entered are invalid.");
				}
				
			}
			
			$(document).ready(function() {
				
				$("#username").focus();
				
				$("#login").on("click", function() {
					
					login();
					
				});
				
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

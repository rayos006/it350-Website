<!DOCTYPE html>
<?php
session_start();
	if($_SESSION["loggedIn"] === "no"){
		echo '<script type="text/javascript">alert("Login Failed!"); </script>';
		session_destroy();
	}
require("header.php");
require("nav.php");
?>
<html>
	<head>
		<title>Log-In</title>
	</head>
	<body>
		<div class="ui raised container segment" style="width=80%">
			<form class="ui form" action="./admin/login.php" method="Post">
				<div class="field">
					<label>Username</label>
					<input type="text" name="UserName" placeholder="Username">
				</div>
				<div class="field">
					<label>Password</label>
					<input type="password" name="Password" placeholder="Password">
				</div>
				<button class="ui button" type="submit">Submit</button>
			</form>
		</div>
	</body>
</html> 

<!DOCTYPE html>
<?php
session_start();
	if($_SESSION["logged_in"] === "no"){
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
			<form class="ui form">
				<div class="field">
					<label>Username</label>
					<input type="text" name="userName" placeholder="Username">
				</div>
				<div class="field">
					<label>Password</label>
					<input type="password" name="password" placeholder="Password">
				</div>
				<button class="ui button" type="submit"action="./admin/login.php">Submit</button>
			</form>
		</div>
	</body>
</html> 

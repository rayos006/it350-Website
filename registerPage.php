<?php
session_start();
	if($_SESSION["user_created"] === "no"){
		echo '<script type="text/javascript">alert("That username is taken!"); </script>';
		session_destroy();
	}
require("header.php");
require("nav.php");
?>
<html>
	<body>
		<div class="ui raised container segment" style="width=80%">
			<h1 class="ui header">Customers</h1>
			<form class="ui form">
				<div class="field">
					<label>Name</label>
					<input type="text" name="Name" placeholder="Name">
				</div>
				<div class="field">
					<label>Email</label>
					<input type="email" name="Email" placeholder="Email">
				</div>
				<div class="field">
					<label>Username</label>
					<input type="text" name="UserName" placeholder="Username">
				</div>
				<div class="field">
					<label>Password</label>
					<input type="password" name="Password" placeholder="Password">
				</div>
				<div class="field">
					<label>CompanyID</label>
					<input type="text" name="CompanyId" placeholder="CompanyID">
				</div>
				<div class="field">
					<input name="type" value="Customer">
				</div>
				<button class="ui button" type="submit"action="./admin/register.php">Submit</button>
			</form>
		</div>
		<div class="ui raised container segment" style="width=80%">
			<h1 class="ui header">Employees</h1>
			<form class="ui form">
				<div class="field">
					<label>Name</label>
					<input type="text" name="Name" placeholder="Name">
				</div>
				<div class="field">
					<label>Email</label>
					<input type="text" name="Email" placeholder="Email">
				</div>
				<div class="field">
					<label>Username</label>
					<input type="text" name="UserName" placeholder="Username">
				</div>
				<div class="field">
					<label>Password</label>
					<input type="text" name="Password" placeholder="Password">
				</div>
				<div class="field">
					<label>BranchID</label>
					<input type="text" name="BrachId" placeholder="BranchID">
				</div>
				<div class="field">
					<input name="type" value="Employee">
				</div>
				<button class="ui button" type="submit"action="./admin/register.php">Submit</button>
			</form>
		</div>
	<section>
			<form method="post" action= "register.php">
			<div class="row">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-5">
					<div class="form-group">
						<label for="name">Name:</label>
						<input type="name" class="form-control" id="name" placeholder="Your name" name= "name" required>
					</div>
				</div>
				<div class="col-sm-2">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-5">
					<div class="form-group">
						<label for="username">Username:</label>
						<input type="username" class="form-control" id="username" placeholder="Username" name= "username" required>
					</div>
				</div>
				<div class="col-sm-2">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-5">
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" class="form-control" id="email" placeholder="Enter an Email" name= "email" required>
					</div>
				</div>
				<div class="col-sm-2">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-5">
					<div class="form-group">
						<label for="password">Password:</label>
						<input type="password" class="form-control" id="pwd" placeholder="Password" name= "password" required>
					</div>
				</div>
				<div class="col-sm-2">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-5">
					<div class="form-group">
					<label for="pwd">Confirm Password:</label>
					<input type="password" class="form-control" id="conpwd" placeholder="Confirm password" name= "Conpassword" required>
				</div>
				</div>
				<div class="col-sm-2">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-5">
					<button type="submit" action="register.php" class="btn btn-default">Submit
				</button>
				</div>
				<div class="col-sm-2">
				</div>
			</div>
			</form>
			<footer>
				<p id="footer">
					Copyright 2016 Tyler Ray
				</p>
			</footer>
		</section>
		<script>
var password = document.getElementById("pwd")
  , confirm_password = document.getElementById("conpwd");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
		</script>
	</body>
</html> 

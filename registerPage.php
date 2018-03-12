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
		<div class="ui raised container segment">
			<h1 class="ui header">Customers</h1>
			<form class="ui form" action="./admin/register.php" method="Post">
				<div class="required field">
					<label>Name</label>
					<input type="text" name="Name" placeholder="Name">
				</div>
				<div class="required field">
					<label>Email</label>
					<input type="email" name="Email" placeholder="Email">
				</div>
				<div class="required field">
					<label>Username</label>
					<input type="text" name="UserName" placeholder="Username">
				</div>
				<div class="required field">
					<label>Password</label>
					<input type="password" name="Password" placeholder="Password">
				</div>
				<div class="required field">
					<label>CompanyID</label>
					<input type="text" name="CompanyId" placeholder="CompanyID">
				</div>
				<div class="field" style="display:none">
					<input name="type" value="Customer">
				</div>
				<div class="field" style="display:none">
                        <input name="Redirect" value="Redirect">
                    </div>
				<div class="ui error message"></div>
				<button class="ui button" type="submit">Submit</button>
			</form>
		</div>
		<div class="ui raised container segment">
			<h1 class="ui header">Employees</h1>
			<form class="ui form" action="./admin/register.php" method="Post">
				<div class="required field">
					<label>Name</label>
					<input type="text" name="Name" placeholder="Name">
				</div>
				<div class="required field">
					<label>Email</label>
					<input type="text" name="Email" placeholder="Email">
				</div>
				<div class="required field">
					<label>Username</label>
					<input type="text" name="UserName" placeholder="Username">
				</div>
				<div class="required field">
					<label>Password</label>
					<input type="password" name="Password" placeholder="Password">
				</div>
				<div class="required field">
					<label>BranchID</label>
					<input type="text" name="BranchId" placeholder="BranchID">
				</div>
				<div class="field" style="display:none">
					<input name="type" value="Employee">
				</div>
				<div class="field" style="display:none">
                    <input name="Redirect" value="Redirect">
                </div>
				<div class="field" style="display:none">
                    <input name="Admin" value="0">
                </div>
				<div class="ui error message"></div>
				<button class="ui button" type="submit">Submit</button>
			</form>
		</div>
	</body>
</html> 

<script>
$('.ui.form')
  .form({
    fields: {
      Name: {
        identifier: 'Name',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please enter your name'
          }
        ]
      },
	  Email: {
        identifier: 'Email',
        rules: [
          {
            type   : 'email',
            prompt : 'Please enter a valid email'
          }
        ]
      },
      UserName: {
        identifier: 'UserName',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please enter a username'
          }
        ]
      },
	  CompanyId: {
        identifier: 'CompanyId',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please enter your CompanyId'
          },
          {
            type   : 'minLength[4]',
            prompt : 'Your password must be at least {ruleValue} characters'
          }
        ]
      },
      Password: {
        identifier: 'Password',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please enter a password'
          },
          {
            type   : 'minLength[8]',
            prompt : 'Your password must be at least {ruleValue} characters'
          }
        ]
      }
	}
  })
;
</script>
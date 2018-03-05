<?php
session_start();
			require('settings.php');
			$previous_location = $_SESSION['previous_location'];
			if ($db_found){
				if($_POST['type'] == 'Customer'){
					$username = $_POST['UserName'];
					$password = hash('sha1',$_POST['Password']);
					$email = $_POST['Email'];
					$name = $_POST['Name'];
				}
				else{
					$username = $_POST['UserName'];
					$password = hash('sha1',$_POST['Password']);
					$email = $_POST['Email'];
					$name = $_POST['Name'];
					$companyId = $_POST['CompanyId'];
				}
					



				$query = "SELECT * FROM $table WHERE username= '$username'" or die("Failed to find username");
				$result = mysqli_query($db_handle, $query);
				if ($result->num_rows == 1) {
					$_SESSION["user_created"] = "no";
					header("location:registerPage.php");
				}
				else {
				$query2 ="INSERT INTO $table (`name`, `username`, `password`, `email`, `logged_in`) VALUES ('$name','$username','$password','email','1')" or die("Failed to add user");
					mysqli_query($db_handle, $query2);
					$_SESSION["username"] = $username;
					$_SESSION["logged_in"] = "yes";
					header("location:$previous_location");
 }


}
			else {
				print "Database NOT Found";
			}

			mysqli_close($db_handle);
?>


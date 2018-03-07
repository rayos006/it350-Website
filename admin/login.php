<?php
session_start();
			require('settings.php');
			$previous_location = $_SESSION['previous_location'];
			if ($db_found){
				$username = $_POST['UserName'];
				$password = hash('sha1',$_POST['Password']);


				$query = "SELECT * FROM $users WHERE Username = '$username' and Password = '$password'" or die("Failed to find username");
				$result = mysqli_query($db_handle, $query);
				if ($result->num_rows == 1) {
					$sql = "UPDATE $users SET loggedIn='1' WHERE Username='$username'" or die();
					$result = mysqli_query($db_handle, $sql);
					$query2 = "SELECT * FROM $employee WHERE Username = '$username'" or die("Failed to find username");
					$result = mysqli_query($db_handle, $query2);
					$obj = $result->fetch_object();
						if ($result->num_rows == 1 && $obj->Admin == 1) {
							$_SESSION['admin'] = 1;
						}
					$_SESSION['username'] = $username;
					$_SESSION['loggedIn'] = "yes";
					print $previous_location;
					header("Location:../home.php");
				}
				else {
					$_SESSION["loggedIn"] = "no";
					header("location:../loginPage.php");
 }


}
			else {
				print "Database NOT Found";
			}

			mysqli_close($db_handle);
?>

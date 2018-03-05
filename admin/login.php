<?php
session_start();
			require('settings.php');
			$previous_location = $_SESSION['previous_location'];
			if ($db_found){
				$username = $_POST['username'];
				$password = hash('sha1',$_POST['password']);


				$query = "SELECT * FROM $table WHERE username= '$username'and password= '$password'" or die("Failed to find username");
				$result = mysqli_query($db_handle, $query);
				if ($result->num_rows == 1) {
				while($row = $result->fetch_assoc()) {
					$_SESSION['userid'] = $row['userid'];
				}
				$sql = "UPDATE $table SET logged_in='1' WHERE username='$username'" or die();
				$result = mysqli_query($db_handle, $sql);
					$_SESSION['username'] = $username;
					$_SESSION['logged_in'] = "yes";
						header("Location:$previous_location");
				}
				else {
					$_SESSION["logged_in"] = "no";
					header("location:loginPage.php");
 }


}
			else {
				print "Database NOT Found";
			}

			mysqli_close($db_handle);
?>

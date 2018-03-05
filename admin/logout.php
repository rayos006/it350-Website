<?php
session_start();
			require('settings.php');
			if ($db_found){
				$username = $_SESSION["username"];
				$sql = "UPDATE $table SET logged_in='0' WHERE username='$username'" or die();
				$result = mysqli_query($db_handle, $sql);
					session_destroy();
				setcookie( "PHPSESSID", '' , time() - 3600);
					header("Location:loginPage.php");
}
			else {
				print "Database NOT Found";
			}

			mysqli_close($db_handle);
?>
<?php
session_start();
			require('settings.php');
			$previous_location = $_SESSION['previous_location'];
			if ($db_found){
				$username = $username = $password = $email = $name = $companyId = $branchId = $customerId = "";
				if($_POST['type'] == 'Customer'){
					$username = $_POST['UserName'];
					$password = hash('sha1',$_POST['Password']);
					$email = $_POST['Email'];
					$name = $_POST['Name'];
					$companyId = $_POST['CompanyId'];
					$customerId = rand(1000000,9999999);



					$query = "SELECT * FROM $users WHERE Username= '$username'" or die("Failed to find username");
					$result = mysqli_query($db_handle, $query);
					if ($result->num_rows == 1) {
						$_SESSION["user_created"] = "no";
						header("location:../registerPage.php");
					}
					else {
						$query2 ="INSERT INTO $users (`Name`, `Username`, `Password`, `Email`, `loggedIn`) VALUES ('$name','$username','$password','$email','0')" or die("Failed to add user");
						mysqli_query($db_handle, $query2);
						$query3 = "INSERT INTO $customer (`Username`, `CompanyId`, `CustomerId`) VALUES ('$username','$companyId', '$customerId')" or die("Failed to add user");
						mysqli_query($db_handle, $query3);
						header("location:../loginPage.php");
					}
				}
				else {
					$username = $_POST['UserName'];
					$password = hash('sha1',$_POST['Password']);
					$email = $_POST['Email'];
					$name = $_POST['Name'];
					$branchId = $_POST['BranchId'];
					$query = "SELECT * FROM $users WHERE Username= '$username'" or die("Failed to find username");
					$result = mysqli_query($db_handle, $query);
					if ($result->num_rows == 1) {
						$_SESSION["user_created"] = "no";
						header("location:../registerPage.php");
					}
					else {
						$query2 ="INSERT INTO $users (`Name`, `Username`, `Password`, `Email`, `loggedIn`) VALUES ('$name','$username','$password','$email','0')" or die("Failed to add user");
						mysqli_query($db_handle, $query2);
						$query3 = "INSERT INTO $employee (`Username`, `BranchId`) VALUES ('$username','$branchId')" or die("Failed to add user");
						mysqli_query($db_handle, $query3);
						header("location:../loginPage.php");
					}
				}
			}
			else {
				print "Database NOT Found";
			}
			mysqli_close($db_handle);
?>


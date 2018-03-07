<?php
session_start();
			require('settings.php');
			if ($db_found){
                if($_GET['action'] == 'GetCustomers'){
                    $query = "SELECT a.Username, a.Name, a.Email, b.CompanyId, b.CustomerId FROM $users AS a, $customer AS b WHERE a.Username = b.Username" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query);
                    while($row = $result->fetch_assoc()) {
                    $obj = $result->fetch_object();
                    $myJSON = json_encode($obj);
                    echo $myJSON;
                    }
                }
            }
            else {
				print "Database NOT Found";
			}

			mysqli_close($db_handle);
?>
<!DOCTYPE html>
<?php
session_start();
require("header.php");
require("nav.php");
    if($_SESSION["admin"] != 1){
        echo "You are not authorized to view this page! Please contact your Administrator to request access.";
        header("HTTP/1.1 401 Unauthorized");
        exit;
	}

?>
<html>
	<head>
		<title>Admin</title>
	</head>
	<body>
        <div class="ui raised container segment">
            <h1>Customers:</h1>
            <button onclick="getCustomers()" class="ui right small primary button">
            Load Data
            </button>
            
            <table class="ui compact celled definition table">
                <thead class="full-width">
                    <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>CompanyId</th>
                    <th>CustomerId</th>
                    </tr>
                </thead>
                <tbody id="CustomersTable">
                </tbody>
                <tfoot class="full-width">
                    <tr>
                    <th></th>
                    <th colspan="5">
                        <button class="ui right floated small primary labeled icon button">
                        <i class="user icon"></i> Add Customer
                        </button>
                        <button class="ui small red disabled button">
                        Delete
                        </button>
                        <button class="ui small red disabled button">
                        Delete All
                        </button>
                    </th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="ui raised container segment">
            <h1>View Employees:</h1>
            <button class="ui primary button">Add Employee</button>
        </div>
	</body>
</html> 
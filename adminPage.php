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

    <!-- ********************************************  CUSTOMER SECTION  ******************************************** -->
        <div class="ui raised container segment">
            <h1>Customers:</h1>
            <button id="customerButton" onclick="getCustomers()" class="ui right small primary button">
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
                    <th>Reviews</th>
                    </tr>
                </thead>
                <tbody id="CustomersTable">
                </tbody>
                <tfoot class="full-width">
                    <tr>
                    <th></th>
                    <th colspan="6">
                        <button id="addCustomer" onclick="addCustomer()" class="ui right floated small primary labeled icon button">
                        <i class="user icon"></i> Add Customer
                        </button>
                        <button id="deleteCustomers" onclick="deleteCustomers()" class="ui small red disabled button">
                        Delete
                        </button>
                        <button id="deleteAllCustomers" onclick="deleteAllCustomers()" class="ui small red disabled button">
                        Delete All
                        </button>
                    </th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="ui special customerReview modal">
            <div class="header">
            Reviews:
            </div>
            <div class="content">
                <table class="ui compact celled definition table">
                    <thead class="full-width">
                        <tr>
                        <th>ReviewId</th>
                        <th>CustomerId</th>
                        <th>SupplyId</th>
                        <th>Rating</th>
                        <th>Text</th>
                        <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="customerReviewsTable">
                    </tbody>
                </table>
            <div class="ui hidden divider"></div>
            </div>
            <div class="actions">
            <button class="ui positive right labeled icon button">
                Done
                <i class="checkmark icon"></i>
            </button>
            </div>
        </div>

        <div class="ui special customer modal">
            <div class="header">
            Add Customer
            </div>
            <div class="content">
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
                        <input name="Redirect" value="NoRedirect">
                    </div>
                    <div class="ui error message"></div>
                
            <div class="ui hidden divider"></div>
            </div>
            <div class="actions">
            <div class="ui negative button">
                Cancel
            </div>
            <button class="ui positive right labeled icon button" type="submit">
                Add
                <i class="checkmark icon"></i>
            </button>
            </div>
            </form>
        </div>

        <!-- ********************************************  EMPLOYEE SECTION  ******************************************** -->
        <div class="ui raised container segment">
            <h1>Employees:</h1>
            <button id="employeeButton" onclick="getEmployees()" class="ui right small primary button">
            Load Data
            </button>
            
            <table class="ui compact celled definition table">
                <thead class="full-width">
                    <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>BranchId</th>
                    <th>Admin</th>
                    </tr>
                </thead>
                <tbody id="EmployeesTable">
                </tbody>
                <tfoot class="full-width">
                    <tr>
                    <th></th>
                    <th colspan="5">
                        <button id="addEmployee" onclick="addEmployee()" class="ui right floated small primary labeled icon button">
                        <i class="user icon"></i> Add Employee
                        </button>
                        <button id="deleteEmployees" onclick="deleteEmployees()" class="ui small red disabled button">
                        Delete
                        </button>
                        <button id="deleteAllEmployees" onclick="deleteAllEmployees()" class="ui small red disabled button">
                        Delete All
                        </button>
                    </th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="ui special employee modal">
            <div class="header">
            Add Employee
            </div>
            <div class="content">
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
                        <label>BranchID</label>
                        <input type="text" name="CompanyId" placeholder="CompanyID">
                    </div>
                    <div class="required field">
                        <label>Admin</label>
                        <input type="text" name="Admin" placeholder="1 or 0">
                    </div>
                    <div class="field" style="display:none">
                        <input name="type" value="Employee">
                    </div>
                    <div class="field" style="display:none">
                        <input name="Redirect" value="NoRedirect">
                    </div>
                    <div class="ui error message"></div>
                
            <div class="ui hidden divider"></div>
            </div>
            <div class="actions">
            <div class="ui negative button">
                Cancel
            </div>
            <button class="ui positive right labeled icon button" type="submit">
                Add
                <i class="checkmark icon"></i>
            </button>
            </div>
            </form>
        </div>
    <!-- ********************************************  COMPANY SECTION ********************************************  -->
        <div class="ui raised container segment">
            <h1>Companies:</h1>
            <button id="companyButton" onclick="getCompanies()" class="ui right small primary button">
            Load Data
            </button>
            
            <table class="ui compact celled definition table">
                <thead class="full-width">
                    <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>CompanyId</th>
                    <th>Account Info</th>
                    </tr>
                </thead>
                <tbody id="CompaniesTable">
                </tbody>
                <tfoot class="full-width">
                    <tr>
                    <th></th>
                    <th colspan="5">
                        <button id="addCompany" onclick="showCompany()" class="ui right floated small primary labeled icon button">
                        <i class="building icon"></i> Add Company
                        </button>
                        <button id="deleteCompanies" onclick="deleteCompanies()" class="ui small red disabled button">
                        Delete
                        </button>
                        <button id="deleteAllCompanies" onclick="deleteAllCompanies()" class="ui small red disabled button">
                        Delete All
                        </button>
                    </th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="ui special account modal">
            <div class="header">
            Accounts
            </div>
            <div class="content">
                <table class="ui compact celled definition table">
                    <thead class="full-width">
                        <tr>
                        <th></th>
                        <th>Account Type</th>
                        <th>Account Number</th>
                        <th>Routing Number</th>
                        <th>Type</th>
                        </tr>
                    </thead>
                    <tbody id="BankAccountTable">
                    </tbody>
                    <thead class="full-width">
                        <tr>
                        <th></th>
                        <th>Account Type</th>
                        <th>Card Number</th>
                        <th>CVV</th>
                        <th>Billing Address</th>
                        <th>Name on Card</th>
                        </tr>
                    </thead>
                    <tbody id="CardAccountTable">
                    </tbody>
                    <tfoot class="full-width">
                        <tr>
                        <th></th>
                        <th colspan="5">
                            <button id="addBankAccount" onclick="showBank()" class="ui right floated small primary labeled icon button">
                            <i class="user icon"></i> Add Bank Account
                            </button>
                            <button id="addCardAccount" onclick="showCard()" class="ui right floated small primary labeled icon button">
                            <i class="user icon"></i> Add Card Account
                            </button>
                            <button id="deleteAccounts" onclick="deleteAccounts()" class="ui small red disabled button">
                            Delete
                            </button>
                            <button id="deleteAllAccounts" onclick="deleteAllAccounts(this.id)" class="ui small red disabled button">
                            Delete All
                            </button>
                        </th>
                        </tr>
                    </tfoot>
                </table>
                <form class="ui bank hidden form" method="POST">
                    <div class="field" style="display:none">
                        <input name="category" value="bank">
                    </div>
                        <div class="required field">
                        <label>Account Number</label>
                        <input type="text" name="AccountNumber" placeholder="Account Number">
                    </div>
                    <div class="required field">
                        <label>Routing Number</label>
                        <input type="text" name="RoutingNumber" placeholder="Routing Number">
                    </div>
                    <div class="required field">
                        <label>Account Type</label>
                        <input type="text" name="Type" placeholder="Account Type">
                    </div>
                    <div class="ui error message"></div>
                    </form>
                <form class="ui cardAccount hidden form" method="POST">
                    <div class="field" style="display:none">
                        <input name="category" value="card">
                    </div>
                    <div class="required field">
                        <label>Card Number</label>
                        <input type="text" name="CardNumber" placeholder="Card Number">
                    </div>
                    <div class="required field">
                        <label>CVV</label>
                        <input type="text" name="CVV" placeholder="CVV">
                    </div>
                    <div class="required field">
                        <label>Billing Address</label>
                        <input type="text" name="BillingAddress" placeholder="Billing Address">
                    </div>
                    <div class="required field">
                        <label>Name on Card</label>
                        <input type="text" name="NameOnCard" placeholder="Name on Card">
                    </div>
                    <div class="ui error message"></div>
                    </form>
                    <div id="accountCancel" onclick="closeNewAccount()" class="ui negative hidden button">
                        Cancel
                    </div>
                    <button id="accountConfirm" onclick="addAccount()" class="ui green hidden right button" >
                        Add
                    </button>
                
            <div class="ui hidden divider"></div>
            </div>
            <div class="actions">
            <div class="ui negative button">
                Cancel
            </div>
            <button class="ui positive right labeled icon button">
                Done
                <i class="checkmark icon"></i>
            </button>
            </div>

        </div>
        <div class="ui special company modal">
            <div class="header">
            Add Company
            </div>
            <div class="content">
                <form class="ui company form" method="Post">
                    <div class="required field">
                        <label>Name</label>
                        <input type="text" name="Name" placeholder="Name">
                    </div>
                    <div class="required field">
                        <label>Address</label>
                        <input type="text" name="Address" placeholder="Address">
                    </div>
                    <div class="ui error message"></div>
                </form>
                <div class="ui hidden divider"></div>
            </div>
            <div class="actions">
            <div class="ui negative button">
                Cancel
            </div>
            <button onclick="addCompany()"class="ui positive right labeled icon button" type="submit">
                Add
                <i class="checkmark icon"></i>
            </button>
            </div>
            
        </div>


        <!--  ******************************************** ORDER SECTION  ******************************************** -->
        <div class="ui raised container segment">
            <h1>Orders:</h1>
            <button id="orderButton" onclick="getOrders()" class="ui right small primary button">
            Load Data
            </button>
            
            <table class="ui compact celled definition table">
                <thead class="full-width">
                    <tr>
                    <th></th>
                    <th>OrderId</th>
                    <th>CompanyId</th>
                    <th>AccountId</th>
                    <th>Supplies</th>
                    <th>CustomerId</th>
                    <th>Shipped</th>
                    </tr>
                </thead>
                <tbody id="OrdersTable">
                </tbody>
                <tfoot class="full-width">
                    <tr>
                    <th></th>
                    <th colspan="6">
                        <button id="showOrder" onclick="showOrder()" class="ui right floated small primary labeled icon button">
                        <i class="shopping cart icon"></i> Add Order
                        </button>
                        <button id="deleteOrders" onclick="deleteOrders()" class="ui small red disabled button">
                        Delete
                        </button>
                        <button id="deleteAllOrders" onclick="deleteAllOrders()" class="ui small red disabled button">
                        Delete All
                        </button>
                    </th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="ui special order modal">
            <div class="header">
            Add Order
            </div>
            <div class="content">
                <form class="ui order form" method="Post">
                    <div class="required field">
                        <label>CompanyId</label>
                        <input type="text" name="CompanyId" placeholder="CompanyId">
                    </div>
                    <div class="required field">
                        <label>AccountId</label>
                        <input type="text" name="AccountId" placeholder="AccountId">
                    </div>
                    <div class="required field">
                        <select id="supplySelect" multiple="" class="ui dropdown">
                        </select>
                    </div>
                    <div class="required field">
                        <label>CustomerId</label>
                        <input type="text" name="CustomerId" placeholder="CustomerId">
                    </div>
                    <div class="required field">
                        <label>Shipped</label>
                        <input type="text" name="CompanyId" placeholder="CompanyID">
                    </div>
                    <div class="ui error message"></div>
                </form>
                <div class="ui hidden divider"></div>
            </div>
            <div class="actions">
                <div class="ui negative button">
                    Cancel
                </div>
                <button onclick="addOrder()" class="ui positive right labeled icon button">
                    Add
                    <i class="checkmark icon"></i>
                </button>
            </div>
        </div>

        <div class="ui special orderSupplies modal">
            <div class="header">
            Supplies
            </div>
            <div class="content">
                <table id="paperOrderSupply" class="ui compact celled definition table hidden">
                    <thead class="full-width">
                        <tr id="paperOrderSupplyHeaderTable">
                     </tr>
                    </thead>
                    <tbody>
                        <tr id="paperOrderSupplyInfoTable"></tr>
                    </tbody>
                    <tfoot class="full-width">
                        <tr>
                            <th colspan="6"></th>
                        </tr>
                    </tfoot>
                </table>
                <table id="printTonerOrderSupply" class="ui compact celled definition table hidden">
                    <thead class="full-width">
                        <tr id="printTonerOrderSupplyHeaderTable">
                     </tr>
                    </thead>
                    <tbody>
                        <tr id="printTonerOrderSupplyInfoTable"></tr>
                    </tbody>
                    <tfoot class="full-width">
                        <tr>
                            <th colspan="6"></th>
                        </tr>
                    </tfoot>
                </table>
                <table id="printersOrderSupply" class="ui compact celled definition table hidden">
                    <thead class="full-width">
                        <tr id="printersOrderSupplyHeaderTable">
                     </tr>
                    </thead>
                    <tbody>
                        <tr id="printersOrderSupplyInfoTable"></tr>
                    </tbody>
                    <tfoot class="full-width">
                        <tr>
                            <th colspan="6"></th>
                        </tr>
                    </tfoot>
                </table>
                <table id="officeSuppliesOrderSupply" class="ui compact celled definition table hidden">
                    <thead class="full-width">
                        <tr id="officeSuppliesOrderSupplyHeaderTable">
                     </tr>
                    </thead>
                    <tbody>
                        <tr id="officeSuppliesOrderSupplyInfoTable"></tr>
                    </tbody>
                    <tfoot class="full-width">
                        <tr>
                            <th colspan="6"></th>
                        </tr>
                    </tfoot>
                </table>
                <table id="stickyQuipsOrderSupply" class="ui compact celled definition table hidden">
                    <thead class="full-width">
                        <tr id="stickyQuipsOrderSupplyHeaderTable">
                     </tr>
                    </thead>
                    <tbody>
                        <tr id="stickyQuipsOrderSupplyInfoTable"></tr>
                    </tbody>
                    <tfoot class="full-width">
                        <tr>
                            <th colspan="6"></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="ui hidden divider"></div>
            </div>
            <div class="actions">
                <button onclick="closeSupplyOrder()" class="ui positive right labeled icon button">
                    Done
                    <i class="checkmark icon"></i>
                </button>
            </div>
            
        </div>
   <!-- ********************************************  Supplies SECTION ********************************************  -->
        <div class="ui raised container segment">
            <h1>Supplies:</h1>
            <button id="supplyButton" onclick="getSupplies()" class="ui right small primary button">
            Load Data
            </button>
            
            <table class="ui compact celled definition table">
                <thead class="full-width">
                    <tr>
                    <th></th>
                    <th>SupplyId</th>
                    <th>Name</th>
                    <th>InStock</th>
                    <th>Price</th>
                    <th>Picture</th>
                    <th>Info</th>
                    </tr>
                </thead>
                <tbody id="SuppliesTable">
                </tbody>
                <tfoot class="full-width">
                    <tr>
                    <th></th>
                    <th colspan="6">
                        <button id="addSupply" onclick="showSupply()" class="ui right floated small primary labeled icon button">
                        <i class="plus square icon"></i> Add Supply
                        </button>
                        <button id="deleteSupplies" onclick="deleteSupplies()" class="ui small red disabled button">
                        Delete
                        </button>
                        <button id="deleteAllSupplies" onclick="deleteAllSupplies()" class="ui small red disabled button">
                        Delete All
                        </button>
                    </th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="ui special supply modal">
            <div class="header">
            Add Supply:
            </div>
            <div class="content">
                <select id="subSelect" class="ui search dropdown">
                            <option value="1">Paper</option>
                            <option value="2">Printers</option>
                            <option value="3">Print Toner</option>
                            <option value="4">Sticky Quips</option>
                            <option value="5">Office Supplies</option>
                </select>
                <br><br>
                <form class="ui paper hidden form" method="POST">
                    <div class="field" style="display:none">
                        <input name="category" value="paper">
                    </div>
                        <div class="required field">
                        <label>Name</label>
                        <input type="text" name="Name" placeholder="Name">
                    </div>
                    <div class="required field">
                        <label>In Stock</label>
                        <input type="text" name="InStock" placeholder="1 or 0">
                    </div>
                    <div class="required field">
                        <label>Price</label>
                        <input type="text" name="Price" placeholder="Price">
                    </div>
                    <div class="required field">
                        <label>Picture</label>
                        <input type="text" name="Picture" placeholder="Location of picture">
                    </div>
                    <div class="required field">
                        <label>Color</label>
                        <input type="text" name="Color" placeholder="Color">
                    </div>
                    <div class="required field">
                        <label>Size</label>
                        <input type="text" name="Size" placeholder="Size">
                    </div>
                    <div class="required field">
                        <label>Weight</label>
                        <input type="text" name="Weight" placeholder="Weight">
                    </div>
                    <div class="ui error message"></div>
                </form>
                <form class="ui printers hidden form" method="POST">
                    <div class="field" style="display:none">
                        <input name="category" value="printers">
                    </div>
                        <div class="required field">
                        <label>Name</label>
                        <input type="text" name="Name" placeholder="Name">
                    </div>
                    <div class="required field">
                        <label>In Stock</label>
                        <input type="text" name="InStock" placeholder="1 or 0">
                    </div>
                    <div class="required field">
                        <label>Price</label>
                        <input type="text" name="Price" placeholder="Price">
                    </div>
                    <div class="required field">
                        <label>Picture</label>
                        <input type="text" name="Picture" placeholder="Location of picture">
                    </div>
                    <div class="required field">
                        <label>Toner Type</label>
                        <input type="text" name="TonerType" placeholder="Toner Type">
                    </div>
                    <div class="required field">
                        <label>Size</label>
                        <input type="text" name="Size" placeholder="Size">
                    </div>
                    <div class="required field">
                        <label>Brand</label>
                        <input type="text" name="Brand" placeholder="Brand">
                    </div>
                    <div class="ui error message"></div>
                </form>
                <form class="ui printToner hidden form" method="POST">
                    <div class="field" style="display:none">
                        <input name="category" value="printToner">
                    </div>
                        <div class="required field">
                        <label>Name</label>
                        <input type="text" name="Name" placeholder="Name">
                    </div>
                    <div class="required field">
                        <label>In Stock</label>
                        <input type="text" name="InStock" placeholder="1 or 0">
                    </div>
                    <div class="required field">
                        <label>Price</label>
                        <input type="text" name="Price" placeholder="Price">
                    </div>
                    <div class="required field">
                        <label>Picture</label>
                        <input type="text" name="Picture" placeholder="Location of picture">
                    </div>
                    <div class="required field">
                        <label>Color</label>
                        <input type="text" name="Color" placeholder="Color">
                    </div>
                    <div class="required field">
                        <label>Size</label>
                        <input type="text" name="Size" placeholder="Size">
                    </div>
                    <div class="required field">
                        <label>Type</label>
                        <input type="text" name="Type" placeholder="Type">
                    </div>
                    <div class="required field">
                        <label>Brand</label>
                        <input type="text" name="Brand" placeholder="Brand">
                    </div>
                    <div class="ui error message"></div>
                </form>
                <form class="ui stickyQuips hidden form" method="POST">
                    <div class="field" style="display:none">
                        <input name="category" value="stickyQuips">
                    </div>
                        <div class="required field">
                        <label>Name</label>
                        <input type="text" name="Name" placeholder="Name">
                    </div>
                    <div class="required field">
                        <label>In Stock</label>
                        <input type="text" name="InStock" placeholder="1 or 0">
                    </div>
                    <div class="required field">
                        <label>Price</label>
                        <input type="text" name="Price" placeholder="Price">
                    </div>
                    <div class="required field">
                        <label>Picture</label>
                        <input type="text" name="Picture" placeholder="Location of picture">
                    </div>
                    <div class="required field">
                        <label>Color</label>
                        <input type="text" name="Color" placeholder="Color">
                    </div>
                    <div class="required field">
                        <label>Size</label>
                        <input type="text" name="Size" placeholder="Size">
                    </div>
                    <div class="ui error message"></div>
                </form>
                <form class="ui officeSupplies hidden form" method="POST">
                    <div class="field" style="display:none">
                        <input name="category" value="officeSupplies">
                    </div>
                        <div class="required field">
                        <label>Name</label>
                        <input type="text" name="Name" placeholder="Name">
                    </div>
                    <div class="required field">
                        <label>In Stock</label>
                        <input type="text" name="InStock" placeholder="1 or 0">
                    </div>
                    <div class="required field">
                        <label>Price</label>
                        <input type="text" name="Price" placeholder="Price">
                    </div>
                    <div class="required field">
                        <label>Picture</label>
                        <input type="text" name="Picture" placeholder="Location of picture">
                    </div>
                    <div class="required field">
                        <label>Color</label>
                        <input type="text" name="Color" placeholder="Color">
                    </div>
                    <div class="required field">
                        <label>Size</label>
                        <input type="text" name="Size" placeholder="Size">
                    </div>
                    <div class="required field">
                        <label>Type</label>
                        <input type="text" name="Type" placeholder="Type">
                    </div>
                    <div class="required field">
                        <label>Brand</label>
                        <input type="text" name="Brand" placeholder="Brand">
                    </div>
                    <div class="ui error message"></div>
                </form>          
                <div class="ui hidden divider"></div>
            </div>
            <div class="actions">
                <div onclick="closeNewSupply()" class="ui negative button">
                    Cancel
                </div>
                <button onclick="addSupply()" class="ui positive right labeled icon button">
                    Add
                     <i class="checkmark icon"></i>
                </button>
            </div>
        </div>

        <!-- <div class="ui special supplyInfo modal">
            <div class="header">
                More Info:
            </div>
            <div class="content">
                <table class="ui compact celled definition table">
                    <thead class="full-width">
                        <tr id="supplyHeaderTable">
                     </tr>
                    </thead>
                    <tbody>
                        <tr id="supplyInfoTable"></tr>
                    </tbody>
                    <tfoot class="full-width">
                        <tr>
                            <th colspan="6"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="actions">
                <button onclick="closeSupplyInfo()" class="ui positive right labeled icon button">
                    Done
                    <i class="checkmark icon"></i>
                </button>
            </div>
        </div> -->

        <!-- ********************************************  REVIEWS SECTION  ******************************************** -->
        <div class="ui raised container segment">
            <h1>Reviews:</h1>
            <button id="reviewButton" onclick="getReviews()" class="ui right small primary button">
            Load Data
            </button>
            
            <table class="ui compact celled definition table">
                <thead class="full-width">
                    <tr>
                    <th></th>
                    <th>ReviewId</th>
                    <th>CustomerId</th>
                    <th>SupplyId</th>
                    <th>Rating</th>
                    <th>Text</th>
                    <th>Date</th>
                    </tr>
                </thead>
                <tbody id="ReviewsTable">
                </tbody>
                <tfoot class="full-width">
                    <tr>
                    <th></th>
                    <th colspan="6">
                        <button id="deleteReviews" onclick="deleteReviews()" class="ui small red disabled button">
                        Delete
                        </button>
                        <button id="deleteAllReviews" onclick="deleteAllReviews()" class="ui small red disabled button">
                        Delete All
                        </button>
                    </th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="ui special review modal">
            <div class="header">
            Review Text
            </div>
            <div class="content">
                <p id="reviewText"></p>
            </div>
            <div class="actions">
            <button onclick="clearReviews() "class="ui positive right labeled icon button" type="submit">
                Done
                <i class="checkmark icon"></i>
            </button>
            </div>
            </form>
        </div>

	</body>
</html> 
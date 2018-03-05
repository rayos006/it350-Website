<html>
<body>

<?php
$database = "tylerdra_dunder";
$users = "Users";
$employee = "Employee";
$bank = "Bank";
$card = "Card";
$company = "Company";
$officeSupplies = "OfficeSupplies";
$orders = "Orders";
$paper = "Paper";
$paymentOption = "PaymentOption";
$printers = "Printers";
$printToner = "PrintToner";
$reviews = "Reviews";
$stickyQuips = "StickyQuips";
$supplies = "Supplies";

//Note that you'll need to update your username and password below
$db_handle = mysqli_connect("localhost","tylerdra_ray1red","Password1");
$db_found = mysqli_select_db($db_handle, $database);


//As a challenge you can try and have it check if the records were actually added
//and if not, have it send an error message instead of the "One record added" message
?> 

</body>
</html>
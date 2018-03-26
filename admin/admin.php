<?php
session_start();
			require('settings.php');
			if ($db_found){
                // ******************************************** USER SECTION ******************************************** 
                if($_GET['action'] == 'getUsers'){
                    $query = "SELECT Username, Name FROM $users" or die("Failed to find username");
                    $result = mysqli_fetch_all(mysqli_query($db_handle, $query), MYSQLI_ASSOC);
                    $myJSON = json_encode($result);
                    echo $myJSON;
                }
                // ******************************************** CUSTOMER SECTION ******************************************** 
                elseif($_GET['action'] == 'getCustomers'){
                    $query = "SELECT a.Username, a.Name, a.Email, b.CompanyId, b.CustomerId FROM $users AS a, $customer AS b WHERE a.Username = b.Username" or die("Failed to find username");
                    $result = mysqli_fetch_all(mysqli_query($db_handle, $query), MYSQLI_ASSOC);
                    $myJSON = json_encode($result);
                    echo $myJSON;
                }
                elseif ($_POST['action'] == 'deleteCustomers') {
                    foreach ($_POST['customers'] as &$username) {
                        $query = "DELETE a,b FROM $users AS a, $customer AS b WHERE a.Username = '$username' AND b.Username = '$username'" or die("Failed to find username");
                        $result = mysqli_query($db_handle, $query);
                        echo $username;
                    }
                }
                elseif($_POST['action'] == 'deleteAllCustomers') {
                    $query = "DELETE a,b FROM $users AS a, $customer AS b WHERE a.Username = b.Username" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query);
                    echo $result;
                }
                elseif($_GET['action'] == 'getCustomerReviews'){
                    $customerId = $_GET['customerId'];
                    $query = "SELECT * FROM $reviews WHERE CustomerId = '$customerId'" or die("Failed to find username");
                    $result = mysqli_fetch_all(mysqli_query($db_handle, $query), MYSQLI_ASSOC);
                    $myJSON = json_encode($result);
                    echo $myJSON;
                }
                //  ******************************************** EMPLOYEE SECTION ******************************************** 
                elseif($_GET['action'] == 'getEmployees'){
                    $query = "SELECT a.Username, a.Name, a.Email, b.BranchId, b.Admin FROM $users AS a, $employee AS b WHERE a.Username = b.Username" or die("Failed to find username");
                    $result = mysqli_fetch_all(mysqli_query($db_handle, $query), MYSQLI_ASSOC);
                    $myJSON = json_encode($result);
                    echo $myJSON;
                }
                elseif ($_POST['action'] == 'deleteEmployees') {
                    foreach ($_POST['employees'] as &$username) {
                        $query = "DELETE a,b FROM $users AS a, $employee AS b WHERE a.Username = '$username' AND b.Username = '$username'" or die("Failed to find username");
                        $result = mysqli_query($db_handle, $query);
                        echo $username;
                    }
                }
                elseif($_POST['action'] == 'deleteAllEmployees') {
                    $query = "DELETE a,b FROM $users AS a, $employee AS b WHERE a.Username = b.Username" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query);
                    echo $result;
                }
                //  ******************************************** Company SECTION ******************************************** 
                elseif($_GET['action'] == 'getCompanies'){
                    $query = "SELECT * FROM $company WHERE 1" or die("Failed to find username");
                    $result = mysqli_fetch_all(mysqli_query($db_handle, $query), MYSQLI_ASSOC);
                    $myJSON = json_encode($result);
                    echo $myJSON;
                }
                elseif($_POST['action'] == 'addCompany') {
                    $accountId = rand(1000000,9999999);
                    $companyId = rand(1000000,9999999);
                    $data = $_POST['data'];
                    $name = $data[0]['value'];
                    $mail = $data[1]['value'];
                    $query = "INSERT INTO $company (`Name`, `MailingAddress`, `CompanyId`) VALUES ('$name','$mail','$companyId')";
                    $result1 = mysqli_query($db_handle, $query);
                    $query2 = "INSERT INTO $paymentOption (`CompanyID`, `AccountId`) VALUES ('$companyId', '$accountId')";
                    $result = mysqli_query($db_handle, $query2);                   
                    echo $result1;
                }
                elseif ($_POST['action'] == 'deleteCompanies') {
                    foreach ($_POST['companies'] as &$companyId) {
                        $query = "SELECT AccountId FROM $paymentOption WHERE CompanyId = '$companyId'";
                        $result = mysqli_query($db_handle, $query);
                        $obj = $result->fetch_object();
                        $accountId = $obj->AccountId;
                        $query3 = "DELETE a,d FROM $card AS a, $paymentOption AS d WHERE a.AccountId = '$accountId' AND d.AccountId = '$accountId'" or die("Failed to find username");
                        $result = mysqli_query($db_handle, $query3);
                        $query4 = "DELETE a,d FROM $bank AS a, $paymentOption AS d WHERE a.AccountId = '$accountId' AND d.AccountId = '$accountId'" or die("Failed to find username");
                        $result = mysqli_query($db_handle, $query4);
                        $query2 = "DELETE a,d FROM $company AS a, $paymentOption AS d WHERE a.CompanyId = '$companyId' AND d.CompanyId = '$companyId'" or die("Failed to find username");
                        $result = mysqli_query($db_handle, $query2);
                        echo $accountId;
                    }
                }
                elseif($_POST['action'] == 'deleteAllCompanies') {
                    $query = "DELETE FROM $company" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query);
                    $query2 = "DELETE FROM $paymentOption" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query2);
                    $query3 = "DELETE FROM $card" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query3);
                    $query4 = "DELETE FROM $bank" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query4);
                    echo $result;
                }
                // ******************************************** Account Section  ******************************************** 
                elseif($_GET['action'] == 'getAccountId') {
                    $companyId = $_GET['companyId'];
                    $query = "SELECT AccountId FROM $paymentOption WHERE CompanyId = '$companyId'";
                    $result = mysqli_query($db_handle, $query);
                    $obj = $result->fetch_object();                 
                    echo $obj->AccountId;
                }
                elseif($_GET['action'] == 'getBankAccounts') {
                    $companyId = $_GET['companyId'];
                    $query = "SELECT * FROM $paymentOption AS a, $bank AS b WHERE a.CompanyId = '$companyId' AND a.AccountId = b.AccountId";
                    $result = mysqli_fetch_all(mysqli_query($db_handle, $query), MYSQLI_ASSOC);
                    $myJSON = json_encode($result);
                    echo $myJSON;
                }
                elseif($_GET['action'] == 'getCardAccounts') {
                    $companyId = $_GET['companyId'];
                    $query = "SELECT * FROM $paymentOption AS a, $card AS c WHERE a.CompanyId = '$companyId' AND a.AccountId = c.AccountId";
                    $result = mysqli_fetch_all(mysqli_query($db_handle, $query), MYSQLI_ASSOC);
                    $myJSON = json_encode($result);
                    echo $myJSON;
                }
                elseif ($_POST['action'] == 'deleteAccounts') {
                    foreach ($_POST['accounts'] as &$identifier) {
                        $array = explode(',',$identifier);
                        if ($array[0] == "bank"){
                            $accountId = $array[1];
                            $accountNumber = $array[2];
                            $query = "DELETE FROM $bank WHERE AccountId = '$accountId' AND AccountNumber = '$accountNumber'" or die("Failed to find username");
                            $result = mysqli_query($db_handle, $query);
                        }
                        else{
                            $accountId = $array[1];
                            $cardNumber = $array[2];
                            $query = "DELETE FROM $card WHERE AccountId = '$accountId' AND CardNumber = '$cardNumber'" or die("Failed to find username");
                            $result = mysqli_query($db_handle, $query);
                        }
                    }
                    $query2 = "SELECT CompanyId FROM PaymentOption WHERE AccountId = '$accountId'";
                    $result = mysqli_query($db_handle, $query2);
                    $obj = $result->fetch_object();                    
                    echo $obj->CompanyId;
                }
                elseif($_POST['action'] == 'deleteAllAccounts') {
                    $accountId = $_POST['accountId'];
                    $query = "DELETE FROM $card WHERE AccountId = '$accountId'" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query);
                    $query2 = "DELETE FROM $bank WHERE AccountId = '$accountId'" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query2);
                }
                elseif($_POST['action'] == 'addCardAccount') {
                    $accountId = $_POST['accountId'];
                    $data = $_POST['data'];
                    $cardNumber = $data[1]['value'];
                    $cvv = $data[2]['value'];
                    $address = $data[3]['value'];
                    $cardName = $data[4]['value'];
                    $query = "INSERT INTO $card (AccountId, CardNumber, CVV, BillingAddress, CardName) VALUES ('$accountId','$cardNumber','$cvv','$address','$cardName')";
                    $result = mysqli_query($db_handle, $query);
                    $query2 = "SELECT CompanyId FROM PaymentOption WHERE AccountId = '$accountId'";
                    $result = mysqli_query($db_handle, $query2);
                    $obj = $result->fetch_object();                    
                    echo $obj->CompanyId;
                }
                elseif($_POST['action'] == 'addBankAccount') {
                    $accountId = $_POST['accountId'];
                    $data = $_POST['data'];
                    $accountNumber = $data[1]['value'];
                    $route = $data[2]['value'];
                    $type = $data[3]['value'];
                    $query = "INSERT INTO $bank (AccountId, AccountNumber, RoutingNumber, TypeOfAccount) VALUES ('$accountId','$accountNumber','$route','$type')";
                    $result = mysqli_query($db_handle, $query);
                    $query2 = "SELECT CompanyId FROM PaymentOption WHERE AccountId = '$accountId'";
                    $result = mysqli_query($db_handle, $query2);
                    $obj = $result->fetch_object();                    
                    echo $obj->CompanyId;
                }
                // ******************************************** Orders Section  ******************************************** 
                elseif($_GET['action'] == 'getOrders'){
                    $query = "SELECT * FROM $orders" or die("Failed to find username");
                    $result = mysqli_fetch_all(mysqli_query($db_handle, $query), MYSQLI_ASSOC);
                    $myJSON = json_encode($result);
                    echo $myJSON;
                }
                elseif ($_POST['action'] == 'deleteOrders') {
                    foreach ($_POST['orders'] as &$orderId) {
                        $query = "DELETE FROM $orders WHERE OrderId = '$orderId'" or die("Failed to find username");
                        $result = mysqli_query($db_handle, $query);
                        $query2 = "DELETE FROM $lookupOS WHERE OrderId = '$orderId'" or die("Failed to find username");
                        $result = mysqli_query($db_handle, $query2);
                        echo $orderId;
                    }
                }
                elseif($_POST['action'] == 'deleteAllOrders') {
                    $query = "DELETE FROM $orders" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query);
                    $query2 = "DELETE FROM $lookupOS" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query2);
                    echo $result;
                }
                elseif($_POST['action'] == 'addOrder') {
                    $data = $_POST['data'];
                    $orderId = rand(1000000,9999999);
                    $supplies = $_POST['supplyList'];
                    $companyId = $data[0]['value'];
                    $accountId = $data[1]['value'];
                    $customerId = $data[2]['value'];
                    $shipped = $data[3]['value'];
                    $query = "INSERT INTO $orders (OrderId, CompanyId, AccountId, CustomerId, Shipped) VALUES ('$orderId','$companyId','$accountId','$customerId','$shipped')";
                    $result = mysqli_query($db_handle, $query);
                    foreach ($supplies as &$supplyId) {
                        $query2 = "INSERT INTO $lookupOS (OrderId, SupplyId) VALUES ('$orderId','$supplyId')";
                        $result = mysqli_query($db_handle, $query2);       
                    }            
                    echo $result;
                }
                elseif($_GET['action'] == 'getOrderSupplies'){
                    $orderId = $_GET['orderId'];
                    $query = "SELECT SupplyId FROM $lookupOS WHERE OrderId = '$orderId'" or die("Failed to find username");
                    $result = mysqli_fetch_all(mysqli_query($db_handle, $query), MYSQLI_ASSOC);
                    foreach ($result as $value) {
                        foreach ($value as $supplyId) {
                            $query = "SELECT * FROM $paper WHERE SupplyId = '$supplyId'" or die("Failed to find username");
                            $result = mysqli_query($db_handle, $query);
                            if ($result->num_rows >= 1) {
                                $obj = $result->fetch_object();                    
                                $myJSON = json_encode($obj);
                            }
                            $query3 = "SELECT * FROM $printToner WHERE SupplyId = '$supplyId'" or die("Failed to find username");
                            $result3 = mysqli_query($db_handle, $query3);
                            if ($result3->num_rows >= 1) {
                                $obj = $result3->fetch_object();                    
                                $myJSON1 = json_encode($obj);
                            }
                            $query4 = "SELECT * FROM $printers WHERE SupplyId = '$supplyId'" or die("Failed to find username");
                            $result4 = mysqli_query($db_handle, $query4);
                            if ($result4->num_rows >= 1) {
                                $obj = $result4->fetch_object();                    
                                $myJSON2 = json_encode($obj);
                            }
                            $query5 = "SELECT * FROM $stickyQuips WHERE SupplyId = '$supplyId'" or die("Failed to find username");
                            $result5 = mysqli_query($db_handle, $query5);
                            if ($result5->num_rows >= 1 ) {
                                $obj = $result5->fetch_object();                    
                                $myJSON3 = json_encode($obj);
                            }
                            $query6 = "SELECT * FROM $officeSupplies WHERE SupplyId = '$supplyId'" or die("Failed to find username");
                            $result6 = mysqli_query($db_handle, $query6);
                            if ($result6->num_rows >= 1 ) {
                                $obj = $result6->fetch_object();                    
                                $myJSON4 = json_encode($obj);
                            }
                        }
                    }
                    echo json_encode(array($myJSON,$myJSON1,$myJSON2,$myJSON3,$myJSON4));
                }
                // ******************************************** Supplies Section  ******************************************** 
                elseif($_GET['action'] == 'getSupplies'){
                    $query = "SELECT * FROM $supplies" or die("Failed to find username");
                    $result = mysqli_fetch_all(mysqli_query($db_handle, $query), MYSQLI_ASSOC);
                    $myJSON = json_encode($result);
                    echo $myJSON;
                }
                elseif ($_POST['action'] == 'deleteSupplies') {
                    foreach ($_POST['supplies'] as &$supplyId) {
                        $query = "DELETE FROM $supplies WHERE SupplyId = '$supplyId'" or die("Failed to find username");
                        $result = mysqli_query($db_handle, $query);
                        $query2 = "DELETE FROM $paper WHERE SupplyId = '$supplyId'" or die("Failed to find username");
                        $result = mysqli_query($db_handle, $query2);
                        $query3 = "DELETE FROM $printToner WHERE SupplyId = '$supplyId'" or die("Failed to find username");
                        $result = mysqli_query($db_handle, $query3);
                        $query4 = "DELETE FROM $printers WHERE SupplyId = '$supplyId'" or die("Failed to find username");
                        $result = mysqli_query($db_handle, $query4);
                        $query5 = "DELETE FROM $stickyQuips WHERE SupplyId = '$supplyId'" or die("Failed to find username");
                        $result = mysqli_query($db_handle, $query5);
                        $query6 = "DELETE FROM $officeSupplies WHERE SupplyId = '$supplyId'" or die("Failed to find username");
                        $result = mysqli_query($db_handle, $query6);
                        echo $supplyId;
                    }
                }
                elseif($_POST['action'] == 'deleteAllSupplies') {
                    $query = "DELETE FROM $supplies" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query);
                    $query2 = "DELETE FROM $paper" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query2);
                    $query3 = "DELETE FROM $printToner" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query3);
                    $query4 = "DELETE FROM $printers" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query4);
                    $query5 = "DELETE FROM $stickyQuips" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query5);
                    $query6 = "DELETE FROM $officeSupplies" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query6);
                    echo $result;
                }
                elseif($_POST['action'] == 'addSupply') {
                    $data = $_POST['data'];
                    $supplyId = rand(1000000,9999999);
                    $type = $_POST['type'];
                    $name = $data[1]['value'];
                    $stock = $data[2]['value'];
                    $price = $data[3]['value'];
                    $picture = $data[4]['value'];
                    $query = "INSERT INTO $supplies (SupplyId, Name, InStock, Price, Picture) VALUES ('$supplyId','$name','$stock','$price','$picture')";
                    $result = mysqli_query($db_handle, $query);
                    if($type == 'paper'){
                        $color = $data[5]['value'];
                        $size = $data[6]['value'];
                        $weight = $data[7]['value'];
                        $query = "INSERT INTO $paper (SupplyId, Color, Size, Weight) VALUES ('$supplyId','$color','$size','$weight')";
                        $result = mysqli_query($db_handle, $query);
                        echo $result;
                    }
                    elseif ($type == 'printers') {
                        $toner = $data[5]['value'];
                        $size = $data[6]['value'];
                        $brand = $data[7]['value'];
                        $query = "INSERT INTO $printers (SupplyId, TonerType, Size, Brand) VALUES ('$supplyId','$toner','$size','$brand')";
                        $result = mysqli_query($db_handle, $query);
                        echo $result;
                    }
                    elseif ($type == 'printToner') {
                        $color = $data[5]['value'];
                        $size = $data[6]['value'];
                        $type = $data[7]['value'];
                        $brand = $data[8]['value'];
                        $query = "INSERT INTO $printToner (SupplyId, Color, Size, Type, Brand) VALUES ('$supplyId','$color','$size','$type','$brand')";
                        $result = mysqli_query($db_handle, $query);
                        echo $result;
                    }
                    elseif ($type == 'stickyQuips') {
                        $color = $data[5]['value'];
                        $size = $data[6]['value'];
                        $query = "INSERT INTO $stickyQuips (SupplyId, Color, Size) VALUES ('$supplyId','$color','$size')";
                        $result = mysqli_query($db_handle, $query);
                        echo $result;
                    }
                    elseif ($type == 'officeSupplies') {
                        $color = $data[5]['value'];
                        $size = $data[6]['value'];
                        $type = $data[7]['value'];
                        $brand = $data[8]['value'];
                        $query = "INSERT INTO $officeSupplies (SupplyId, Color, Size, Type, Brand) VALUES ('$supplyId','$color','$size','$type','$brand')";
                        $result = mysqli_query($db_handle, $query);
                        echo $result;
                    }          
                }
                elseif($_GET['action'] == 'getSupplyInfo') {
                    $supplyId = $_GET['supplyId'];
                    $query = "SELECT * FROM $paper WHERE SupplyId = '$supplyId'" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query);
                    if ($result->num_rows >= 1) {
                        $obj = $result->fetch_object();                    
                        $myJSON = json_encode($obj);
                        echo $myJSON;
                    }
                    $query3 = "SELECT * FROM $printToner WHERE SupplyId = '$supplyId'" or die("Failed to find username");
                    $result3 = mysqli_query($db_handle, $query3);
                    if ($result3->num_rows >= 1) {
                        $obj = $result3->fetch_object();                    
                        $myJSON = json_encode($obj);
                        echo $myJSON;
                    }
                    $query4 = "SELECT * FROM $printers WHERE SupplyId = '$supplyId'" or die("Failed to find username");
                    $result4 = mysqli_query($db_handle, $query4);
                    if ($result4->num_rows >= 1) {
                        $obj = $result4->fetch_object();                    
                        $myJSON = json_encode($obj);
                        echo $myJSON;
                    }
                    $query5 = "SELECT * FROM $stickyQuips WHERE SupplyId = '$supplyId'" or die("Failed to find username");
                    $result5 = mysqli_query($db_handle, $query5);
                    if ($result5->num_rows >= 1 ) {
                        $obj = $result5->fetch_object();                    
                        $myJSON = json_encode($obj);
                        echo $myJSON;
                    }
                    $query6 = "SELECT * FROM $officeSupplies WHERE SupplyId = '$supplyId'" or die("Failed to find username");
                    $result6 = mysqli_query($db_handle, $query6);
                    if ($result6->num_rows >= 1 ) {
                        $obj = $result6->fetch_object();                    
                        $myJSON = json_encode($obj);
                        echo $myJSON;
                    }
                }
                elseif($_GET['action'] == 'getSupply') {
                    $supplyId = $_GET['supplyId'];
                    $query = "SELECT * FROM $supplies WHERE SupplyId = '$supplyId'" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query);
                    $obj = $result->fetch_object();
                    $myJSON = json_encode($obj);
                    echo $myJSON;
                }
                //  ******************************************** REVIEW SECTION ******************************************** 
                elseif($_GET['action'] == 'getReviews'){
                    $query = "SELECT * FROM $reviews" or die("Failed to find username");
                    $result = mysqli_fetch_all(mysqli_query($db_handle, $query), MYSQLI_ASSOC);
                    $myJSON = json_encode($result);
                    echo $myJSON;
                }
                elseif ($_POST['action'] == 'deleteReviews') {
                    foreach ($_POST['reviews'] as &$reviewId) {
                        $query = "DELETE FROM $reviews WHERE ReviewId = '$reviewId'" or die("Failed to find username");
                        $result = mysqli_query($db_handle, $query);
                        echo $reviewId;
                    }
                }
                elseif($_POST['action'] == 'deleteAllReviews') {
                    $query = "DELETE FROM $reviews" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query);
                    echo $result;
                }
                elseif($_GET['action'] == 'getReviewText'){
                    $reviewId = $_GET['reviewId'];
                    $query = "SELECT Text FROM $reviews WHERE ReviewId = '$reviewId'" or die("Failed to find username");
                    $result = mysqli_query($db_handle, $query);
                    $obj = $result->fetch_object();
                    $myJSON = json_encode($obj);
                        echo $myJSON;
                }
            }
            else {
				print "Database NOT Found";
			}

			mysqli_close($db_handle);
?>
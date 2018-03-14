<?php
	session_start();
	function echoActiveClassIfRequestMatches($requestUri)
{
	$current_file = $_SERVER['PHP_SELF'];
    $current_file_name = basename($_SERVER['PHP_SELF'], ".php");

    if ($current_file_name == $requestUri)
        return 'active';
}

?>
<html>
<body>
  <div class="ui menu">
    <a class="<?=echoActiveClassIfRequestMatches("home")?> item" href="./home.php">Home</a>
    <a class=" <?=echoActiveClassIfRequestMatches("orders")?> item">Orders</a>
    <a class="<?=echoActiveClassIfRequestMatches("admin")?> item" href="./adminPage.php">Admin</a>
    <div class="right menu">
    <?php 
      if (isset($_SESSION['loggedIn'])){
                echo '<a class="' . echoActiveClassIfRequestMatches("logoutPage") .' item" href="./admin/logout.php">Logout</a>';
                echo '<a class="item">Welcome, ' .$_SESSION['username'] .'</a>';
            	}
            	else{
                echo '<a class="' . echoActiveClassIfRequestMatches("loginPage") .' item" href="./loginPage.php">Login</a>';
                echo '<a class="' . echoActiveClassIfRequestMatches("registerPage") .' item" href="./registerPage.php">Sign Up</a>';
            	}
      ?>
    </div>
  </div>       
            
</body>

</html>

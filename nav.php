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
<script type="text/javascript">var username = <?php echo json_encode($_SESSION['username']); ?>;</script>
<script type="text/javascript">var loggedIn = <?php echo json_encode($_SESSION['loggedIn']); ?>;</script>
<html>
<body>
  <div class="ui menu">
    <a class="<?=echoActiveClassIfRequestMatches("home")?> item" href="./home.php">Home</a>
    <a class=" <?=echoActiveClassIfRequestMatches("products")?> item"href="./products.php">Products</a>
    <a class="<?=echoActiveClassIfRequestMatches("adminPage")?> item" href="./adminPage.php">Admin</a>
    <div class="right menu">
    <?php 
      if (isset($_SESSION['loggedIn'])){
                echo '<a class="item">Welcome, ' .$_SESSION['username'] .'</a>';
                echo '<div class="ui dropdown item">My Account<i class="dropdown icon"></i><div class="menu"><a class="' . echoActiveClassIfRequestMatches("orders") .' item">Orders</a><a class="' . echoActiveClassIfRequestMatches("cart") .' item" onclick="openCart()">Cart</a><a class="' . echoActiveClassIfRequestMatches("messages") .' item" onclick="showMessages()">Messages</a></div></div>';
                echo '<a class="' . echoActiveClassIfRequestMatches("logoutPage") .' item" href="./admin/logout.php">Logout</a>';
            	}
            	else{
                echo '<a class="' . echoActiveClassIfRequestMatches("loginPage") .' item" href="./loginPage.php">Login</a>';
                echo '<a class="' . echoActiveClassIfRequestMatches("registerPage") .' item" href="./registerPage.php">Sign Up</a>';
            	}
      ?>
    </div>
  </div>    
  <!-- ********************************************  PRODUCT INFO MODAL  ******************************************** -->
        <div class="ui special supplyInfo modal">
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
        </div>

        <!-- ********************************************  CART MODAL  ******************************************** -->
        <div class="ui longer cart modal">
            <div class="header">
                Cart:
            </div>
            <div class="content">
              <div id= "supplyList" class="ui two column grid">
    
              </div> 
            </div>
            <div class="actions">
                <button id= "DeleteCartButton" onclick="deleteCart()" class="ui negative right labeled icon button">
                    Delete Cart
                    <i class="trash alternate outline icon"></i>
                </button>
                <button id = "PurchaseCartButton" onclick="purchaseCart()" class="ui positive right labeled icon button">
                    Purchase
                    <i class="checkmark icon"></i>
                </button>
            </div>
        </div>
        <!-- ********************************************  MESSAGES MODALS  ******************************************** -->
        <div class="ui longer messages modal">
            <div class="header">
                Messages:
                  <div style="float:right;" class="ui floating dropdown labeled icon button">
                    <i class="filter icon"></i>
                    <span id= "recipientText" class="text">Recipients</span>
                    <div class="menu">
                      <div class="ui icon search selection input">
                        <i class="search icon"></i>
                        <input type="text" placeholder="Search users...">
                      </div>
                      <div class="divider"></div>
                      <div class="header">
                        <i class="user outline icon"></i>
                        Usernames
                      </div>
                      <div id="usernameList" class="scrolling menu">

                    </div>
                    </div>
                  </div>
            </div>
              <div class="content">
              <div id= "messageList" class="ui two column grid">
    
              </div>
              <hr>
              <div id="messageInputDIV" class="ui action input hidden">
                <input style="width:44em;" id="messageText" type="text" placeholder="Type Message Here">
                <button onclick="sendMessage" class="ui blue right labeled icon button">
                  <i class="paper plane outline icon"></i>
                  Send
                </button>
                <button style="float:right;" onclick="refreshMessages()" class="ui teal action right labeled icon button">
                    Refresh
                    <i class="redo icon"></i>
                </button>
              </div>
            </div>
            <div class="actions">
                <button class="ui positive right labeled icon button">
                    Done
                    <i class="checkmark icon"></i>
                </button>
            </div>
        </div>
            
</body>

</html>

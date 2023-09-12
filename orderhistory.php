<?php
session_start();

include("config.php");

if ($_SESSION["Login"] != "YES") {
    header("Location: login.php");
}

date_default_timezone_set('Asia/Kuala_Lumpur');
$today = date('Y-m-d H:i:s');
if(isset($_SESSION['COUNTER'])){
if (isset($_GET['tp'])) {
  $orderID = $_SESSION['COUNTER'];
  $sqls = "UPDATE Orders SET payment_status='PAID',payment_date='$today',total_price = {$_SESSION['TOTALPRICE']}  WHERE order_id = {$_SESSION['COUNTER']}";
  unset($_GET["curaddr"]);
  if(mysqli_query($conn, $sqls)){
    if(isset($_SESSION['TOTALPRICE'])){
      unset($_SESSION['COUNTER']);
      unset($_SESSION['TOTALPRICE']);
      $_SESSION['PAID'] = "YES";
      $createOrder = "insert into Orders (user_id) VALUES ('{$_SESSION['ID']}');";
      mysqli_query($conn,$createOrder);
      $findOrderID = "SELECT * FROM Orders WHERE user_id = '{$_SESSION['ID']}'";
      $orderID = mysqli_query($conn,$findOrderID);
      if (mysqli_num_rows($orderID) > 0) {
      while($order_ID = mysqli_fetch_assoc($orderID)){
      $_SESSION['COUNTER'] = $order_ID['order_id'];
      }
    }
  }}
  else{
    $em = "Error: " . mysqli_connect_error($conn);
    echo '<script>window.onload = function() { alert("' . $em . '"); }</script>'; // Display the alert message
  }
  
  
}}?>

<html>
<head>
<title>Order List Tepi Sungai UTM</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<?php if($_SESSION['LEVEL']==1){
  echo "<link rel='stylesheet' type='text/css' href='css/ks-css/orderHistorySeller.css' id='stylesheet'>";
}
else{
  echo "<link rel='stylesheet' type='text/css' href='css/ks-css/orderHistory.css' id='stylesheet'>";
}?>
<link rel="stylesheet" type="text/css" href="css/y-css/navigationbar&body.css" id="stylesheet">
<!-- <meta name="editport" content="width=device-width, initial-scale=1"> -->
<style>
/* .infobox {
    width: 200px;
    height: 100px;
    background-color: #3498db;
    color: #fff;
    text-align: center;
    line-height: 100px;
    cursor: pointer;
    }; */
    /* CSS for the modal */
    
    body {
      background-image: url('img/backgroundImage/Cart_background.jpg');
      background-size: cover;        
      background-repeat: no-repeat;
      background-attachment: fixed;      
    }
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fff;
        width: 300px;
        margin: 100px auto;
        padding: 20px;
        text-align: center;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
    }

    /* CSS for the close button */
    .close {
        color: #888;
        float: right;
        font-size: 24px;
        cursor: pointer;
    }

    .close:hover {
        color: #000;
    }
    </style>
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";

      const boxes = document.querySelectorAll('.box');
        const modals = document.querySelectorAll('.modal');
        const closeBtns = document.querySelectorAll('.close');

        // Function to open the modal
        boxes.forEach((box, index) => {
            box.addEventListener('click', () => {
                modals[index].style.display = 'block';
            });
        });

        // Function to close the modal
        closeBtns.forEach((closeBtn, index) => {
            closeBtn.addEventListener('click', () => {
                modals[index].style.display = 'none';
            });
        });

        // Close the modal if the user clicks anywhere outside of it
        window.addEventListener('click', (event) => {
            modals.forEach((modal) => {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });
        });
</script>
</head>
<body> 
  
<?php
include("header.php");
?>popup 
<?php
    
?>
  
  <?php if($_SESSION['LEVEL']==2||$_SESSION['LEVEL']==0):?>
<div class="body-container">
  <div>      
    
            <div class="grid-container1">
              <div class="top">
                  <h1><u>ORDER LIST</u></h1>
              </div>
            </div>
    <div class="grid-container">
    <?php
    $sql = "SELECT * FROM Orders WHERE payment_status = 'PAID' AND user_id = '{$_SESSION['ID']}' ORDER BY payment_date DESC";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) { 
        echo 
        "<div class='infobox' id='infobox' >
            <div class='orderupper'>
                <div class='foodimg'><img src='img/order-food.png'></div>
            <div class='order-container'>
                <div class='orderno'> ORDER ID {$row['order_id']} </div>
            <div class='orderDetails'>";
                $sqli = "SELECT * FROM Orderdetails WHERE order_id = '{$row['order_id']}'";
                $resi = mysqli_query($conn, $sqli);
                if (mysqli_num_rows($resi) > 0) {
                while ($rowi = mysqli_fetch_assoc($resi)) { 
                $menu_name = "SELECT * FROM Menu WHERE menu_code = '$rowi[menu_code]'";
                $query_menu_name = mysqli_query($conn, $menu_name);
                $res_menu_name = mysqli_fetch_assoc($query_menu_name);
                $total_order_price = $rowi['order_quantity'] * $rowi['order_price'];
                
    
                echo "<div class='orderitem'>
                      <div class='menucode'> $rowi[menu_code] </div>
                      <div class='menuname'> $res_menu_name[menu_name] </div>
                      <div class='quantityorder'> x $rowi[order_quantity] </div>
                      <div class='price'> RM $total_order_price </div>
                      </div>";} }
            echo 
            "</div>
            </div></div>
                <div>
                <div class='line'>
                <div class='total'>Total :</div>
                <div class='TotalPrice'>RM $row[total_price]</div>
                </div>
                </div>
               
                
         </div>";}}
         
         
         
?>


    </div>
  </div>
</div>


<?php endif;?>
  <?php if($_SESSION['LEVEL']==1):?>
    <div class="body-container">
  <div>
    <div class="grid-container1">
      <div class="top">
          <h2><u>ORDER HISTORY</u></h2>
      </div>

    <div class="search">
        <div class="search-container">
          <form method='get' action='orderhistory.php'>
            <input type='text' value='' name='userid' placeholder='Enter the user id'/>
            <button type='submit'><i class="fa fa-search"></i></button>
          </form>
      </div>
    </div>
  </div>

    
    <table class="table-container">
      <tr>
           <th>Order ID </th>
           <th>User ID</th>
           <th>Order Details</th>
           <th>Total Price</th>
           <th colspan="3">Address</th>
           <th>Payment Time</th>
        </tr>
        
    <?php if(isset($_GET["userid"])){
    $user_id = $_GET["userid"];
    $sql = "SELECT * FROM Orders WHERE payment_status = 'PAID' AND user_id LIKE '$user_id'";
    if($_GET["userid"]==""){
        $sql = "SELECT * FROM Orders WHERE payment_status = 'PAID'";
    }
}
else{
$sql = "SELECT * FROM Orders WHERE payment_status = 'PAID'";}
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
      $sqla = "SELECT * FROM users WHERE user_id = '{$row['user_id']}'";
      
      $resa = mysqli_query($conn, $sqla);
      if (mysqli_num_rows($resa) > 0) {
          while ($rowa = mysqli_fetch_assoc($resa)) { 
        echo "
        <tr>
           <td>ORD{$row['order_id']} </td>";
        echo "<td> {$row['user_id']} </td>
        <td>
        <table class='orderDetails' style='width: 100%;'>";
        $sqli = "SELECT * FROM Orderdetails WHERE order_id = '{$row['order_id']}'";
        $resi = mysqli_query($conn, $sqli);
        if (mysqli_num_rows($resi) > 0) {
            while ($rowi = mysqli_fetch_assoc($resi)) { 
            $menu_name = "SELECT * FROM Menu WHERE menu_code = '$rowi[menu_code]'";
            $query_menu_name = mysqli_query($conn, $menu_name);
            $res_menu_name = mysqli_fetch_assoc($query_menu_name);
            $total_order_price = $rowi['order_quantity'] * $rowi['order_price'];
    echo "<tr colspan='3'>
    <td style='padding-left: 1rem;'> $rowi[menu_code] </td>
    <td style='padding-right: 20px;'> $res_menu_name[menu_name] </td>
    <td style='padding-left: 20px;'> $rowi[order_quantity] </td>
    </tr>
    ";} }
echo "</table>
</td>
<td>RM $row[total_price] </td>
<td colspan='3'>$rowa[user_address]</td>
<td width='16%'>$row[payment_date]</td>
</tr>";}}}}?>
</table>

    </div>
<?php endif;?>
</body>
</html>

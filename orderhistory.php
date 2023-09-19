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

    body {
      background-image: url('img/backgroundImage/Cart_background.jpg');
      background-size: cover;        
      background-repeat: no-repeat;
      background-attachment: fixed;      
    }
    .food {
  cursor: pointer;
  border: 1px solid #ccc;
  padding: 10px;
  margin: 10px;
  display: inline-block;
}

/* Updated styles for the popup overlay */
.popup-overlay {
display: none;
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent gray background */
z-index: 1;
display: flex;
justify-content: center;
align-items: center;
}

/* CSS for the popup content */
.popup-content {
background-color: #fff; /* White background */
border: 1px solid #ccc;
padding: 20px;
max-width: 600px;
text-align: center;
cursor: pointer;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Box shadow for a subtle elevation */
}

/* Header style */
.popup-content h2 {
font-size: 1.5rem;
margin-bottom: 10px;
}

/* Food item style */
.food-item {
display: flex;
align-items: center;
margin-bottom: 10px;
}

.food-img img {
width: 80px; /* Adjust image width as needed */
height: 60px; /* Adjust image height as needed */
margin-right: 10px;
}

.food-details p {
margin: 0;
text-align: left;
}

/* Line separator */
.line {
border-top: 1px solid #ccc;
margin: 10px 0;
}

/* Total style */
.total p {
font-weight: bold;
font-size: 1.2rem;
}

/* Payment status and time style */
.popup-content h3 {
font-size: 1.2rem;
margin-top: 10px;
}
    
    
    </style>
<script>
 function showPopup(id) {
            const popup = document.getElementById(id);
            if (popup) {
                popup.style.display = "flex";
            }
        }

        function hidePopup(id) {
            const popup = document.getElementById(id);
            if (popup) {
                popup.style.display = "none";
            }
        }
      
</script>
</head>
<body> 
  
<?php
include("header.php");
?>
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
$user_id = $_SESSION['ID'];
$user_query = "SELECT user_name FROM users WHERE user_id = '$user_id'";
$user_result = mysqli_query($conn, $user_query);
$user_row = mysqli_fetch_assoc($user_result);
$customer_name = $user_row['user_name'];

// Retrieve orders for the logged-in user
$sql = "SELECT * FROM Orders WHERE payment_status = 'PAID' AND user_id = '$user_id' ORDER BY payment_date DESC";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        echo "
        <div class='infobox' onclick='showPopup(\"infobox{$row['order_id']}\")'>
            <div class='orderupper'>
                <div class='foodimg'><img src='img/order-food.png'></div>
                <div class='order-container'>
                    <div class='orderno'> ORDER ID {$row['order_id']} </div>
                    <div class='orderDetails'>";
        
        $sqli = "SELECT * FROM Orderdetails WHERE order_id = '{$row['order_id']}'";
        $resi = mysqli_query($conn, $sqli);
        
        if (mysqli_num_rows($resi) > 0) {
            while ($rowi = mysqli_fetch_assoc($resi)) {
                $menu_name = "SELECT * FROM Menu WHERE menu_code = '{$rowi['menu_code']}'";
                $query_menu_name = mysqli_query($conn, $menu_name);
                $res_menu_name = mysqli_fetch_assoc($query_menu_name);
                $total_order_price = $rowi['order_quantity'] * $rowi['order_price'];

                echo "<div class='orderitem'>
                          <div class='menucode'> {$rowi['menu_code']} </div>
                          <div class='menuname'> {$res_menu_name['menu_name']} </div>
                          <div class='quantityorder'> x {$rowi['order_quantity']} </div>
                          <div class='price'> RM {$total_order_price} </div>
                      </div>";
            }
        }
        
        echo "</div></div></div><div><div class='line'>
                  <div class='total'>Total :</div>
                  <div class='TotalPrice'>RM {$row['total_price']}</div>
              </div></div></div>";

        // Create a dynamic popup for each order
        echo "
        <div class='popup-overlay' id='infobox{$row['order_id']}' onclick='hidePopup(\"infobox{$row['order_id']}\")' style='display: none;'>
            <div class='popup-content'>
                <h3> Tepi Sungai UTM </h3>
                <h4> E06, School of Mechanical Engineering</h4>
                 <h4>81310 UTM Johor</h4>
                <h3>Order ID: {$row['order_id']}</h3>
                <h3>Customer Name: $customer_name</h3>";
        
                $resi = mysqli_query($conn, $sqli);
        
                if (mysqli_num_rows($resi) > 0) {
                  $i = 1; // Initialize a counter
        
                  echo "
                  <div class='food-details'>
                    <table>
                      <thead>
                        <tr>
                          <th>No</th>
                          <th style='width:300px;' >Items</th>
                          <th>Price (RM)</th>
                        </tr>
                      </thead>
                      <tbody>";
        
                  while ($rowi = mysqli_fetch_assoc($resi)) {
                      $menu_name = "SELECT * FROM Menu WHERE menu_code = '{$rowi['menu_code']}'";
                      $query_menu_name = mysqli_query($conn, $menu_name);
                      $res_menu_name = mysqli_fetch_assoc($query_menu_name);
                     
                      $total_order_price = $rowi['order_quantity'] * $rowi['order_price'];
                      
                      echo "<tr>
                      <td>{$i}</td>
                      <td>{$rowi['order_quantity']} x {$res_menu_name['menu_name']} (foreach{$res_menu_name['menu_price']})</td>
                      <td class='subtotal'> " . number_format($total_order_price, 2) . "</td>
                  </tr>";
        
                      $i++; // Increment the counter
                  }
        
                  echo "
                      </tbody>
                    </table>
                  </div>";
                }
        
                echo "
                <div class='line'></div>
                <div class='payment-details'>
                    <div class='payment-left'>
                        <p>Total Amount: RM {$row['total_price']}</p>
                        <p>Payment Status: Paid</p>
                        <p>Payment Time: {$row['payment_date']}</p>
                    </div>
                    <div class='payment-right'>
                        <!-- Add your details here -->
                    </div>
                </div>
                </div>
                </div>";
            }
        }
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

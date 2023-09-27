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
    $sqls = "UPDATE Orders SET payment_status='PAID', payment_date='$today', total_price = {$_SESSION['TOTALPRICE']}  WHERE order_id = {$_SESSION['COUNTER']}";
    unset($_GET["curaddr"]);

    if (mysqli_query($conn, $sqls)) {
      if (isset($_SESSION['TOTALPRICE'])) {
        unset($_SESSION['COUNTER']);
        unset($_SESSION['TOTALPRICE']);
        $_SESSION['PAID'] = "YES";
        $createOrder = "insert into Orders (user_id) VALUES ('{$_SESSION['ID']}');";
        mysqli_query($conn, $createOrder);
        $findOrderID = "SELECT * FROM Orders WHERE user_id = '{$_SESSION['ID']}'";
        $orderID = mysqli_query($conn, $findOrderID);
        if (mysqli_num_rows($orderID) > 0) {
          while ($order_ID = mysqli_fetch_assoc($orderID)) {
            $_SESSION['COUNTER'] = $order_ID['order_id'];
          }
        }
      }
    } else {
      $em = "Error: " . mysqli_error($conn); // Use mysqli_error to get the query error message
      echo '<script>window.onload = function() { alert("' . $em . '"); }</script>'; // Display the alert message
    }
  }
}
?>

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

    /* Define the print-button style for screen media */
    .print-button {
        display: block;
    }
    
    /* Popup Overlay Styles */
    .popup-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 1000;
    }

    /* Popup Content Styles */
    .popup-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80%;
        max-width: 600px; /* Adjust the maximum width as needed */
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        padding: 20px;
    }

    /* Header Styles */
    .popup-content h3 {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 10px;
    }

    /* Address Styles */
    .popup-content h4 {
        font-size: 1rem;
        color: #777;
        margin-bottom: 5px;
    }

    /* Table Styles */
    .food-details table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .food-details th, .food-details td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }

    /* Total Amount Styles */
    .payment-details p {
        margin: 10px 0;
        font-size: 1rem;
        color: #333;
    }

    /* Button Styles */
    .print-button {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 1rem;
        cursor: pointer;
    }

    /* Close Button Styles */
    .close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 1.5rem;
        color: #333;
        cursor: pointer;
    }

    .done-button {
        background-color: #4CAF50; /* Green color */
        color: #fff; /* White text color */
        border: none;
        padding: 10px 20px;
        font-size: 1rem;
        cursor: pointer;
    }


    /* Define the print-button style for print media (hidden) */
    @media print {
        .print-button {
            display: none;
        }
    }

    /* Media Query for Responsiveness (Adjust as needed) */
    @media (max-width: 768px) {
        .popup-content {
            width: 90%;
        }
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

    function printReceipt(popupId) {
      var popup = document.getElementById(popupId);
      var contentToPrint = popup.innerHTML;
      var originalBody = document.body.innerHTML;

      // Replace the current page content with the popup content
      document.body.innerHTML = contentToPrint;

      // Print the receipt
      window.print();

      // Restore the original page content
      document.body.innerHTML = originalBody;
    }

    function markAsDone(orderId) {
    // Send an AJAX request to update the preparing status
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "update_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Send order ID as data to the PHP script
    xhr.send("orderId=" + orderId);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response (e.g., update the displayed status)
            const response = xhr.responseText;
            if (response === "success") {
                // Update the displayed status to "Done"
                document.querySelector(`#status-${orderId}`).textContent = "Done";
            } else {
                // Handle errors
                alert("Failed to update status.");
            }
        }
    };
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
    $sql = "SELECT * FROM Orders WHERE user_id = '$user_id' ORDER BY payment_date DESC";
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
                            <p>Payment Status: {$row['payment_status']}</p>
                            <p>Payment Time: {$row['payment_date']}</p>
                            <p>Selected Time-slot for order:{$row['order_time_slot']}</p>
                            <p>Order Type: {$row['order_type']}</p>
                            <p>Payment Method: {$row['payment_method']}</p>
                            <button class='print-button' onclick='printReceipt(\"infobox{$row['order_id']}\")'>Print Receipt</button>
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
           <th>Payment Method</th>
          <th>Payment Status</th>
          <th>Order Time Slot</th>
          <th>Order Type</th>
           <th>Payment Time</th>
           <th>Preparing Status</th> 
           <th>Action</th>
        </tr>
        
    <?php if(isset($_GET["userid"])){
                $user_id = $_GET["userid"];
                $sql = "SELECT *, IFNULL(preparing_status, 'Preparing') AS preparing_status FROM Orders WHERE payment_status = 'PAID' AND user_id LIKE '$user_id'";
                if($_GET["userid"]==""){
                    $sql = "SELECT *, IFNULL(preparing_status, 'Preparing') AS preparing_status FROM Orders WHERE payment_status = 'PAID'";
                }
                }
                else{
                $sql = "SELECT *, IFNULL(preparing_status, 'Preparing') AS preparing_status FROM Orders ";
                }

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
<td>{$row['payment_method']}</td>
<td>{$row['payment_status']}</td>
<td>{$row['order_time_slot']}</td>
<td>{$row['order_type']}</td>
<td width='16%'>$row[payment_date]</td>
<!-- Display the Preparing Status -->
                                <td id='status-{$row['order_id']}'>{$row['preparing_status']}</td>
<td><button class='done-button' onclick='markAsDone({$row['order_id']})'>Done</button></td>
</tr>";}}}}?>
</table>

    </div>
<?php endif;?>
</body>
</html>
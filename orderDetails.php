<?php
session_start();
require_once ("config.php");

if ($_SESSION["Login"] != "YES") {
    header("Location: guest_form.php");
}
date_default_timezone_set('Asia/Kuala_Lumpur');

$today = date('Y-m-d H:i:s');
if(isset($_POST['address'])){
    $post_address = $_POST['address'];
    $sqlz = "UPDATE Users SET user_address = '$post_address' WHERE user_id = '{$_SESSION['ID']}'";
    mysqli_query($conn, $sqlz);
}


?>

<html>
    <head>
        <title>Cart Summary Tepi Sungai UTM</title>
        <link rel='stylesheet' href='css/y-css/navigationbar&body.css'/>
        <link rel="stylesheet" href="css/d-css/orderDetails.css">

    <style>

body {
        background-image: url('img/backgroundImage/Cart_background.jpg');
        background-size: cover;        
        background-repeat: no-repeat;
        background-attachment: fixed; 
    }


    .top {
        margin-bottom: 20px;
    }

    .top h2 {
        font-size: 1.5rem; 
        text-decoration: underline;
    }


    .grid-container {
        display: grid;
        grid-template-columns: 1fr;
        grid-gap: 20px;
    }

    .order-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
    }


    .total-amount {
        font-size: 1.2rem;
        font-weight: bold;
        margin-top: 20px;
    }



    .order-option {
        margin-bottom: 10px;
    }

    .order-option label {
        display: block;
        font-weight: bold;
    }

    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    input[type="submit"] {
        background-color: #e44d26;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }

    input[type="submit"]:hover {
        background-color: #d14020;
    }
    .order-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
        background-color: #fff; /
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
    }


    .menu-image {
        flex: 2;
        padding: 10px; 
        text-align: center;
        background-color: #f9f9f9; 
    }

    .menu-image img { 
        max-width: 150%;
        max-height: 100%;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); 
    }

    .menu-details {
        flex: 3;
        padding: 0 20px; 
    }

    .menu-name {
        font-weight: bold;
        font-size: 1.2rem;
        margin-bottom: 5px;
        color: #333; 
    }

    /* Style the menu price and quantity */
    .menu-price-quantity {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px; /* Add spacing between name and price/quantity */
    }

    .menu-price {
        color: #e44d26; /* Price color */
        font-weight: bold;
    }

    .menu-quantity {
        font-style: italic;
        color: #777; /* Quantity color */
    }



    </style>


    </head>

    <body>
        <?php
        include("header.php");
        ?>

    <div class="body-container">
    <div>
        <div class="grid-container1">
            <div class="top">
                <h2>Cart Summary</h2>
            </div>
        </div>

        

        <div class="grid-container">
        <h2>Order Details</h2>
    
        <?php
        $total_price = 0;
        $sql = "
            SELECT menu_code, SUM(order_quantity) AS total_quantity, 
            SUM(order_price * order_quantity) AS total_price
            FROM Orderdetails
            WHERE order_id = '{$_SESSION['COUNTER']}'
            GROUP BY menu_code
        ";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $menu_name_query = "SELECT * FROM Menu WHERE menu_code = '{$row['menu_code']}'";
                $menu_name_result = mysqli_query($conn, $menu_name_query);
                $menu_name_data = mysqli_fetch_assoc($menu_name_result);
        ?>
            <div class="order-item">
                <div class="menu-image">
                    <img src="img/menuimages/<?php echo $menu_name_data['menu_img']; ?>" alt="Food Image" style="width: 168px; height: 175px;">
                </div>
                <div class="menu-details">
                    <div class="menu-name"><?php echo $menu_name_data['menu_name']; ?></div>
                    <div class="menu-price-quantity">
                        <div class="menu-price">Price: RM <?php echo $menu_name_data['menu_price']; ?></div>
                        <div class="menu-quantity">Quantity: <?php echo $row['total_quantity']; ?></div>
                    </div>
                </div>
            </div>
        <?php
                // Calculate the total price
                $total_price += $row['total_price'];
            }
        } else {
            echo "<p>No Item is added to cart.</p>";
        }
        ?>

            <div class="total-amount">
                Total Amount: RM <?php echo $total_price; ?>
            </div>
</div>
<?php
// Include your database connection code here

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["place-order"])) {
    // Retrieve the selected order options from the form
    $orderType = $_POST['order-type'];
    $orderTimeSlot = $_POST['order-time-slot'];
    $paymentMethod = $_POST['payment-method'];

    // Get the current user's order ID (modify this based on your logic)
    $userId = $_SESSION['ID'];
    $getOrderIdSql = "SELECT order_id FROM Orders WHERE user_id = '$userId' AND payment_status = 'PENDING'";

    $result = mysqli_query($conn, $getOrderIdSql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $currentOrderId = $row['order_id'];

        // Update the 'Orders' table with the selected order options
        $updateSql = "UPDATE Orders
                      SET order_type = '$orderType',
                          order_time_slot = '$orderTimeSlot',
                          payment_method = '$paymentMethod'
                      WHERE order_id = $currentOrderId";

        if (mysqli_query($conn, $updateSql)) {
            echo "Order details updated successfully.";
        } else {
            echo "Error updating order details: " . mysqli_error($conn);
        }
    } else {
        echo "No pending order found for the current user.";
    }
}

// Close the database connection
mysqli_close($conn);
?>
<div class="grid-container2">
    <h2>Order Options</h2>
    <form method="POST" action="process_order.php"> <!-- Replace 'process_order.php' with your processing script -->

        <!-- Order Type Selection -->
        <div class="order-option">
            <label for="order-type">Order Type Selection:</label>
            <select id="order-type" name="order-type">
                <option value="dine-in">Dine-in</option>
                <option value="take-away">Take-Away</option>
            </select>
        </div>

        <!-- Order Time Slot Selection -->
        <div class="order-option">
            <label for="order-time-slot">Select Order Time Slot:</label>
            <select id="order-time-slot" name="order-time-slot">
                <option value="Morning (9:00 AM - 9:15 AM)">Morning (9:00 AM - 9:15 AM)</option>
                <option value="Morning (9:15 AM - 9:30 AM)">Morning (9:15 AM - 9:30 AM)</option>
                <option value="Morning (9:30 AM - 9:45 AM)">Morning (9:30 AM - 9:45 AM)</option>
                <option value="Morning (9:45 AM - 10:00 AM)">Morning (9:45 AM - 10:00 AM)</option>

                <option value="Morning (10:00 AM - 10:15 AM)">Morning (10:00 AM - 10:15 AM)</option>
                <option value="Morning (10:15 AM - 10:30 AM)">Morning (10:15 AM - 10:30 AM)</option>
                <option value="Morning (10:30 AM - 10:45 AM)">Morning (10:30 AM - 10:45 AM)</option>
                <option value="Morning (10:45 AM - 11:00 AM)">Morning (10:45 AM - 11:00 AM)</option>

                <option value="Morning (11:00 AM - 11:15 AM)">Morning (11:00 AM - 11:15 AM)</option>
                <option value="Morning (11:15 AM - 11:30 AM)">Morning (11:15 AM - 11:30 AM)</option>
                <option value="Morning (11:30 AM - 11:45 AM)">Morning (11:30 AM - 11:45 AM)</option>
                <option value="Morning (11:45 AM - 12:00 PM)">Morning (11:45 AM - 12:00 PM)</option>

                
                <option value="Afternoon (1:00 PM - 1:15 PM)">Afternoon (1:00 PM - 1:15 PM)</option>
                <option value="Afternoon (1:15 PM - 1:30 PM)">Afternoon (1:15 PM - 1:30 PM)</option>
                <option value="Afternoon (1:30 PM - 1:45 PM)">Afternoon (1:30 PM - 1:45 PM)</option>
                <option value="Afternoon (1:45 PM - 2:00 PM)">Afternoon (1:45 PM - 2:00 PM)</option>

                <option value="Afternoon (2:00 PM - 2:15 PM)">Afternoon (2:00 PM - 2:15 PM)</option>
                <option value="Afternoon (2:15 PM - 2:30 PM)">Afternoon (2:15 PM - 2:30 PM)</option>
                <option value="Afternoon (2:30 PM - 2:45 PM)">Afternoon (2:30 PM - 2:45 PM)</option>
                <option value="Afternoon (2:45 PM - 3:00 PM)">Afternoon (2:45 PM - 3:00 PM)</option>

                <option value="Afternoon (3:00 PM - 3:15 PM)">Afternoon (3:00 PM - 3:15 PM)</option>
                <option value="Afternoon (3:15 PM - 3:30 PM)">Afternoon (3:15 PM - 3:30 PM)</option>
                <option value="Afternoon (3:30 PM - 3:45 PM)">Afternoon (3:30 PM - 3:45 PM)</option>
                <option value="Afternoon (3:45 PM - 4:00 PM)">Afternoon (3:45 PM - 4:00 PM)</option>


                <option value="Evening (5:00 PM - 5:15 PM)">Evening (5:00 PM - 5:15 PM)</option>
                <option value="Evening (5:15 PM - 5:30 PM)">Evening (5:15 PM - 5:30 PM)</option>
                <option value="Evening (5:30 PM - 5:45 PM)">Evening (5:30 PM - 5:45 PM)</option>
                <option value="Evening (5:45 PM - 6:00 PM)">Evening (5:45 PM - 6:00 PM)</option>

                <option value="Evening (6:00 PM - 6:15 PM)">Evening (6:00 PM - 6:15 PM)</option>
                <option value="Evening (6:15 PM - 6:30 PM)">Evening (6:15 PM - 6:30 PM)</option>
                <option value="Evening (6:30 PM - 6:45 PM)">Evening (6:30 PM - 6:45 PM)</option>
                <option value="Evening (6:45 PM - 7:00 PM)">Evening (6:45 PM - 7:00 PM)</option>

                <option value="Evening (7:00 PM - 7:15 PM)">Evening (7:00 PM - 7:15 PM)</option>
                <option value="Evening (7:15 PM - 7:30 PM)">Evening (7:15 PM - 7:30 PM)</option>
                <option value="Evening (7:30 PM - 7:45 PM)">Evening (7:30 PM - 7:45 PM)</option>
                <option value="Evening (7:45 PM - 8:00 PM)">Evening (7:45 PM - 8:00 PM)</option>

                
            </select>
        </div>

        <!-- Payment Method Selection -->
        <div class="order-option">
            <label for="payment-method">Select Payment Method:</label>
            <select id="payment-method" name="payment-method">
                <option value="cash">Cash</option>
                <option value="online-banking">Online Banking</option>
                <option value="e-wallet">E-Wallet</option>
            </select>
        </div>
        <br>
        <!-- Place Order Button -->
        <input type="submit" value="Place Order" name="place-order">
    </form>
</div>


        
            </div>
        </div>
    </div>
    </div>


    </body>

</html>


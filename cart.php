<!-- <?php
    session_start();
    include("config.php");

    if ($_SESSION["Login"] != "YES") {
        header("Location: guest_form.php");
    }
?> -->

<html>
<head>
    <title>Food Orders</title>
    <link rel='stylesheet' href='css/y-css/navigationbar&body.css'/>
    <link rel="stylesheet" href="css/d-css/cart.css">

    <style>
    body {
        background-image: url('img/backgroundImage/Cart_background.jpg');
        background-size: cover;        
        background-repeat: no-repeat;
        background-attachment: fixed;   /* Keeps the background image fixed while scrolling */
    }

    .body-container2 {
    max-width: 900px;
    margin: auto;
    
    padding-top: 8rem; /*container up padding*/
    padding-bottom: 8rem; /*container up padding*/
}
</style>

</head>

<body>
    <?php
        include("header.php");
    ?>
    <div class="body-container2">
        <div>
            <div class="grid-container1">
                <div class="top">
                    <h3><u>FOOD CART</u></h3>
                </div>

                <div class="date">
                    <div><img src="img/image/calendarlogo.png" style="height: 30px; width: 30px; margin-right: 10px"></div>
                    <div><text style="font-size: 1.1rem; " id="currentDate">dd/mm/yyyy</text></div>
                </div>
            
                <div class="addOrder">
                    <button type="button" class="add" style="font-size: 18px;" onclick="location.href='servicespage.php'">ADD ORDER</button>
                </div>
            </div>
        
            <div class="grid-container">
                <div class="orderDetailsTable">
                    <div class="table order">ORDER</div>
                    
                    <div class="table foodList">
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
                                <div class='food'>
                                    <div class='foodImage'>
                                        <img src='img/menuimages/<?php echo $menu_name_data['menu_img']; ?>' alt='Food Image'>
                                    </div>
                                    <div class='foodNum'><?php echo $row['total_quantity']; ?> x</div>
                                    <div class='foodNameChinese'><?php echo $row['menu_code']; ?> <?php echo $menu_name_data['menu_name']; ?></div>
                                    <div class='foodNameEnglish'><?php echo $menu_name_data['menu_description']; ?></div>
                                    <div class='foodPrice'>RM <?php echo $row['total_price']; ?></div>
                                    <div class='deletebutton'><a href='operation.php?pass=<?php echo $menu_name_data['menu_code']; ?>'>Delete</a></div>
                                </div>
                        <?php
                                $total_price += $row['total_price'];
                            }
                        }
                        ?> 
                    </div>
                    
                    <div class="table total">Total Price</div>
                    <div class="table totalPrice">RM <?php echo $total_price?></div>
                </div>

                <div class="checkoutButton">
                    <a class='btn checkout' href='orderDetails.php?totalprice=<?php echo $total_price ?>'>CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = dd + '/' + mm + '/' + yyyy;
        document.getElementById('currentDate').innerHTML = today;
    </script>
</body>

</html>


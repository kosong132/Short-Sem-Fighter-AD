<!-- <?php
    session_start();
    include("config.php");

    if ($_SESSION["Login"] != "YES") {
        header("Location: guest_form.php");
    }
?> -->

<html>
<head>
    <title>Tepi Sungai UTM Food Cart </title>
    <link rel='stylesheet' href='css/y-css/navigationbar&body.css'/>
  

    <style>
     /* Reset default margin and padding */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

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
   

    /* Global container for the entire content */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Styling for the top section */
    .top {
        grid-column: 1 / 4;
        grid-row: 1 / 2;
        text-align: left;
        padding-top: 20px;
        font-size: 1.8rem;
        font-weight: bold;
    }

    /* Styling for the date section */
    .date {
        display: flex;
        align-items: center;
        grid-column: 1 / 2;
        grid-row: 2 / 3;
        padding: 10px 20px;
        font-size: 1.2rem;
    }

    /* Styling for the calendar icon */
    .calendarImage {
        width: 30px;
        height: 30px;
        margin-right: 10px;
    }

    /* Styling for the "Add Order" button */
    .addOrder {
        grid-column: 3 / 4;
        grid-row: 2 / 3;
        text-align: right;
        padding: 10px 20px;
    }

    .add {
        border: none;
        padding: 12px 24px;
        font-size: 1.2rem;
        cursor: pointer;
        border-radius: 15px;
        background-color: #3498db;
        color: #fff;
        transition: background-color 0.3s;
    }

    .add:hover {
        background-color: #2980b9;
    }

    /* Styling for the order details table */
    .orderDetailsTable {
        grid-row: 2 / 3;
        display: grid;
        grid-template-columns: 0.5fr 2.5fr 1fr;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Styling for the "Order" header */
    .order {
        grid-column: 1 / 4;
        grid-row: 1 / 2;
        font-size: 1.4rem;
        font-weight: bold;
    }

    /* Styling for the food list section */
    .foodList {
        grid-column: 1 / 4;
        grid-row: 2 / 3;
        align-items: center;
        /*border: 0.1rem solid black;*/
        padding: 1rem; /* Add padding for better spacing */
        min-height: 200px; /* Set a minimum height for the empty cart container */
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        font-size: 1.5rem;
        color: #777; /* Adjust the color for a more subtle appearance */
    }

    .foodList.empty {
        border: none; /* Remove border for the empty cart container */
        min-height: auto; /* Reset the minimum height */
    }

    .deletebutton{
        grid-column: 4 / 5;
        grid-row: 1 / 3;
        display:flex;
        align-items: center;
        justify-content: center;
        background-color: #c0392b;
        border-radius: 20px;
    }

    .deletebutton a{
        color: #000000;
    }

    .deletebutton a:hover{
        transform: translateY(-5px);
    }


    /* Styling for the food section */
    .food {
        display: grid;
        grid-template-columns: 1fr 2fr 1fr 1fr;
        grid-template-rows: 1fr 1fr;
        align-items: center;
        font-size: 1.3rem;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        margin-bottom: 10px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        grid-template-areas:
            "image num name price"
            "image desc desc delete";
        background-color: #596988;
        
    }
 
    .food:hover {
      transform: translateY(-5px);
    }

    /* Styling for the food number */
    .foodNum {
        grid-column: 1 / 2;
        grid-row: 1 / 3;
        font-size: 2.3rem;
        padding-left: 5.3rem;
        display: flex;
        align-items: center;
        margin-right: 0.5rem; /* Add spacing here */
        font-weight: bold;
        color:#FFFFFF;
    }

    /* Styling for the Chinese food name */
    .foodNameChinese {
        grid-column: 2 / 3;
        grid-row: 1 / 2;
        padding-top: 1.5rem;
        font-weight: bold;
        color:#FFFFFF;
    }

    /* Styling for the English food name */
    .foodNameEnglish {
        grid-column: 2 / 3;
        grid-row: 2 / 3;
        padding-bottom: 1.5rem;
        color: #FFFFFF;
    }

    /* Styling for the food price */
    .foodPrice {
        grid-column: 3 / 4;
        grid-row: 1 / 3;
        font-size: 1.2rem;
        align-items: center;
        padding-left: 1.8rem;
        color:#FFFFFF;
        /*display:flex;*/
    }

    .foodImage {
        grid-area: image;
        width: 80px; /* Adjust the width as needed */
        height: 80px; /* Adjust the height as needed */
        margin-right: 20px; /* Add spacing between the image and other details */
        overflow: hidden; /* Hide any overflowing parts of the image */
        border-radius: 10px; /* Add border radius for a rounded appearance */
    }

    .foodImage img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Maintain the aspect ratio and cover the container */
    }

    .total{
        grid-column: 1 / 3;
        grid-row: 3 / 4;
        display: flex;
        justify-content: right;
        padding-right: 4rem;
        align-items: center;
        font-size: 1.6rem;
        padding-top: 0.8rem;
        padding-bottom: 0.8rem;
    }

    .totalPrice{
        grid-column: 3 / 4;
        grid-row: 3 / 4;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.3rem;
        padding-top: 0.8rem;
        padding-bottom: 0.8rem;
    }

    .checkoutButton{
        grid-row: 3 / 4;
        text-align: center;
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    .checkoutButton a{
        color: black;
    }

    .btn{
        border: solid black;
        background-color: inherit;
        padding: 14px 28px;
        font-size: 16px;
        cursor: pointer;
        display: inline-block;
        border-radius: 15px;
        text-decoration: none;
    }

    .btn:hover{
        background: #eee;
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

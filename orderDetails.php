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
        <title>Order History Tepi Sungai UTM</title>
        <link rel='stylesheet' href='css/y-css/navigationbar&body.css'/>
        <link rel="stylesheet" href="css/d-css/orderDetails.css">
    </head>

    <body>
        <?php
        include("header.php");
        ?>

    <div class="body-container">
    <div>
        <div class="grid-container1">
            <div class="top">
                <h2><u>ORDER DETAILS</u></h2>
            </div>
        </div>

        <div class="grid-container">
            <div class="orderDetailsTable">
                <div class="table dateLeft">
                    DATE
                </div>
                <div class="table dateRight">
                    <span id="dateValue"><?php
                    echo $today;?></span>
                    
                </div>
                <div class="table addressLeft">
                    ADDRESS
                </div>
                <div class="table addressRight">
                    <?php 
                    $sql = "SELECT * FROM Users WHERE user_id = '{$_SESSION['ID']}'";
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) { 
                        $current_address = $row['user_address'];
                        echo "<span>{$row['user_address']}</span>";
                    }}?>
                    <a href="#">
                        <img src="img/image/editlogo.png" class="editLogo"
                        onclick="document.getElementById('id02').style.display='block'" style="width:auto;">
                    </a>
                </div>
                <div class="table map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1389.8706306946474!2d103.63352261788638!3d1.5660763655532963!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da76b30a24667f%3A0xd9410914e6b13a9d!2sMA1%2C%20Kolej%20Tun%20Dr%20Ismail!5e0!3m2!1sen!2smy!4v1687129735390!5m2!1sen!2smy" 
                    width="840" height="270.67" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>    
                </div>
            </div>

            <div class="payButton">
                <?php
                if(isset($_GET['totalprice'])){
                    $_SESSION['TOTALPRICE'] = $_GET['totalprice'];
                }
                echo "<a class='btn pay' style='text-decoration: none; color: black;' href='orderhistory.php?tp={$_SESSION['TOTALPRICE']}'>PAY</a>";
                ?>
            </div>
        </div>
    </div>
    </div>



        <div id="id02" class="modal">
            <form class="modal-content2 animate" action="orderDetails.php" method="post">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
                </div>
                <div class="container">
                    <label for="address"><b>Address</b></label>
                    <input type="text" value="<?php echo $current_address;?>" name="address" required>
                    <button type="submit" class="modalButton" id="modalButton2">Change</button>
                </div>
            </form>
        </div>

        <script>
            var modal2 = document.getElementById('id02');
            
            window.onclick = function(event) {
                if (event.target == modal2) {
                    modal2.style.display = "none";
                }
                if (event.target == button2) {
                    modal2.style.display = "none";
                }
            }
        </script>

    </body>

</html>


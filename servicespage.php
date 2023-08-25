<?php
session_start();
include("config.php");

date_default_timezone_set('Asia/Kuala_Lumpur');
$today = date('Y-m-d');

if (isset($_GET["pass"])) {
    $pass = $_GET["pass"];}


if ($_SESSION['LEVEL']==2||$_SESSION['LEVEL']==0){
  if(isset($_SESSION["ADDTOCART"])){
    if($_SESSION["ADDTOCART"] == "NO")
        if (isset($_GET['sub'])){
            echo $_GET['sub'];
        }
    
    unset($_SESSION["ADDTOCART"]);
}

if(!isset($_SESSION['COUNTER'])){
    $createOrder = "insert into orders (user_id) VALUES ('{$_SESSION['ID']}');";
    mysqli_query($conn,$createOrder);
    $findOrderID = "SELECT * FROM orders WHERE user_id = '{$_SESSION['ID']}'";
    $orderID = mysqli_query($conn,$findOrderID);
    if (mysqli_num_rows($orderID) > 0) {
    while($order_ID = mysqli_fetch_assoc($orderID)){
    $_SESSION['COUNTER'] = $order_ID['order_id'];
    }}
}
}
?>

<html lang="en">   
<head>
   <title>Customer Order Page</title>
   <link rel='stylesheet' href='css/y-css/navigationbar&body.css'/>
   <?php if($_SESSION['LEVEL']==1):?>
   <link rel='stylesheet' href='css/y-css/serviceSeller.css'/>
   <?php endif;?>
   <?php if($_SESSION['LEVEL']==2||$_SESSION['LEVEL']==0):?>
   <link rel='stylesheet' href='css/y-css/serviceCustomer.css'/>
   <?php endif;?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--windows size responsive-->
  <style>
  body {
        background-image: url('img/backgroundImage/Cart_background.jpg');
        background-size: cover;        
        background-repeat: no-repeat;
        background-attachment: fixed;   /* Keeps the background image fixed while scrolling */
        

    }</style>
  </head>

<body id="service">

<?php 
include("header.php");
?>

<?php if($_SESSION['LEVEL']==1):?>
<div class="body-container">
  <div class="edit-container">
    <div class="grid-container">
      <div class="editMenu">
        <h2><u>EDIT MENU</u></h2>
      </div>

      <div class="date">
        <div><img src="img/servicePageImage/calendar.png" style="height: 30px; width: 30px; margin-right: 10px"></div>
        <div><text style="font-size: 1.1rem;" id="currentDate"><?php echo $today?></text></div>
      </div>
    </div>

    <div class="grid-container2" id="grid-container2">
<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sort = $_POST['sort'];
        $sql = "SELECT * FROM menu ORDER BY $sort";
        $res = mysqli_query($conn, $sql);
    }
    else{
        $sql = "SELECT * FROM menu ORDER BY menu_code";
        $res = mysqli_query($conn, $sql);
    }
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) { 
            echo "
            <div class='food'>
            <div class='thumb'>";?>

            <img class="image" src="img/menuimages/<?=$row['menu_img']?>">
            
    <?php echo "</div><div class='details'>
    <div class='foodID'> $row[menu_code]   $row[menu_name]</div>
    <div class='engName'> $row[menu_description] </div>
    <div class='price'> RM$row[menu_price] </div>
    <div class='edit allbutton'>
    <form method='get' action='servicespage.php'>
      <input name='menucode' type='hidden' value='$row[menu_code]'/>
      <button type='submit' onclick='display();'class='edit allbutton'>Edit</button>
    </form></div>
    <button class='delete allbutton' onclick=location.href='operation.php?pass=$row[menu_code]'>Delete</button>
  </div></div>";
    } } ?>
    
<?php
if (isset($_SESSION['alert_message'])) {
  $em = $_SESSION['alert_message'];
  unset($_SESSION['alert_message']); // Clear the session variable
  echo '<script>window.onload = function() { alert("' . $em . '"); }</script>'; // Display the alert message
}?>
<button id="plusButton" class="allbutton" onclick="document.getElementById('id01').style.display='block'" style="width:auto;"> + </button>

<div id="id01" class="modal">
  <form class="modal-content1 animate" action="validateUpdateMenu.php" method="post" enctype="multipart/form-data">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <h1>Add Item</h1>
    </div>

    <div class="input-container">
      <label for="foodCname"><b>Food's Image: </b></label>
      <input type="file" name="uploadfile" accept="image/jpeg, image/png, image/jpg" required><br><br>

      <label for="foodID"><b>Food's ID</b></label>
      <input type="text" class="foodids" name="menucode" placeholder="" id="foodid" required>

      <label for="foodCname"><b>Food's Name</b></label>
      <input type="text" class="foodCname" name="menuname" placeholder="" required>

      <label for="foodEngName"><b>Food's Description</b></label>
      <input type="text" class="foodEngName" name="menudesc" placeholder="" maxlength="25" required>
        
      <label for="foodPrice"><b>Food Price</b></label>
      <input type="text" class="foodPrice" name="menuprice" placeholder="" required>

      <!--ltr need to change to submit-->
      <button type="submit" name="upload" class="allbutton" id="addButton">ADD</button>
      <!--<input type="button" id="addButton" value="ADD" >-->
      
    </div>

  </form></div>
  <?php if(isset($_GET['menucode'])):
    $menu_code = $_GET["menucode"];
    unset($_GET["menucode"]);?>
    <div id="id02" class="modal2" >
  <form class="modal-content1 animate" action="operation.php" method="post" enctype="multipart/form-data">
    <div class="imgcontainer">
      <span  onclick="document.getElementById('id02').style.display='none';" class="close" title="Close Modal"><a href="servicespage.php" style="text-decoration: none;">&times;</a></span>
      <h1>Edit Item</h1>
    </div>
    <?php 
    $sql = "SELECT * FROM menu WHERE menu_code = '$menu_code'";
    $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) { 
            
                $menu_code = $row["menu_code"];
                $menu_name = $row["menu_name"];
                $menu_price = $row["menu_price"];
                $menu_description = $row["menu_description"]; 
    } } 
    ?>
    <div class="input-container">
      
      <label for="foodCname"><b>Food's Image: </b></label>
      <input type="file" name="uploadfile" accept="image/jpeg, image/png, image/jpg" class="menuimg"><br><br>

      <label for="foodID"><b>Food's ID </b></label>
      <input type="text" class="foodids" name="menucode" value="<?php echo $menu_code; ?>" type="hidden" readonly>

      <label for="foodCname"><b>Food's Name</b></label>
      <input type="text" class="foodCname" name="menuname" value="<?php echo $menu_name; ?>">

      <label for="foodEngName"><b>Food's Description</b></label>
      <input type="text" class="foodEngName" name="menudesc" value="<?php echo $menu_description; ?>" maxlength="25">
        
      <label for="foodPrice"><b>Food Price</b></label>
      <input type="text" class="foodPrice" name="menuprice" value="<?php echo $menu_price; ?>">

      <!--ltr need to change to submit-->
      <button type="submit" name="upload" class="allbutton" id="addButton">Edit</button>
      <!--<input type="button" id="addButton" value="ADD" >-->
      
    </div>
    <?php
if (isset($_SESSION['alert_message'])) {
  $em = $_SESSION['alert_message'];
  unset($_SESSION['alert_message']); // Clear the session variable
  echo '<script>window.onload = function() { alert("' . $em . '"); }</script>'; // Display the alert message
}?>

  </form></div>
  <?php endif;?>
</div></div> 
  <?php endif;?>

  <?php if($_SESSION['LEVEL']==2||$_SESSION['LEVEL']==0):?>
    
  <div class="body-container">
    <div>
    <div class="grid-container">
      <div class="editMenu">
        <h2><u>MENU</u></h2>
      </div>
      <div class="filter">
        <form method="post" action="servicespage.php">
        <select name="sort" id="sort">
            <option value="menu_code"
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'):
                if($_POST['sort']=="menu_code"):?>
            selected
        <?php endif; endif
                ?>>None</option>
            <option value="menu_name" 
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'):
                if($_POST['sort']=="menu_name"):?>
            selected
        <?php endif; endif
                ?>>Name</option>
            <option value="menu_price" 
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'):
                if($_POST['sort']=="menu_price"):?>
            selected
        <?php endif; endif
                ?>>Price</option>
          </select> 
          <button type="submit">Sort</button>
        </form>
      </div>

      <div class="date">
        <div><img src="img/servicePageImage/calendar.png" style="height: 30px; width: 30px; margin-right: 10px"></div>
        <div><text style="font-size: 1.1rem;" id="currentDate"><?php echo $today?></text></div>
      </div>

      <div class="cart">
        <a data-active="cart" href="cart.php"><img src="img/servicePageImage/shopping-cart.png" style="height: 40px; width: 40px; margin-right: 10px"></a></i>
      </div>

    </div>

      <div class="grid-container2" id="grid-container2">
        
        <!--place to insert food-->
        <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sort = $_POST['sort'];
        $sql = "SELECT * FROM menu ORDER BY $sort";
        $res = mysqli_query($conn, $sql);
    }
    else{
        $sql = "SELECT * FROM menu ORDER BY menu_code";
        $res = mysqli_query($conn, $sql);
    }
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) { 
            
            echo "
            <form method='post' action='updateOrder.php'>
            <div class='food'>
            <div class='images'>";?>

            <img class="picturesize" src="img/menuimages/<?=$row['menu_img']?>">
            
        <?php echo "</div>
        <div class='details'>
        <div class='foodIDs'>
        <div class='foodcode'>$row[menu_code]</div>
        <div class='menuname'>$row[menu_name]</div></div>
        <div class='engName'> $row[menu_description] </div>
        <div class='lastrow'><div class='price'> RM $row[menu_price] </div>
        <div class='num'>
        <input type='hidden' name='menu_code[]' value='{$row['menu_code']}'/>
        <input type='number' name='quantity' class='quantity' value='0' min='1'/>
        </div>
        <div class='addfunction'>
        <button type='submit' class='addcart addToCart allbutton'>Add to Cart</button>
        </div></div>
        
      </div></div></form>";
        } } ?>
          
        </div>
      </div>
<?php
if (isset($_SESSION['alert_message'])) {
  $em = $_SESSION['alert_message'];
  unset($_SESSION['alert_message']); // Clear the session variable
  echo '<script>window.onload = function() { alert("' . $em . '"); }</script>'; // Display the alert message
}?>

      
  </div> 
 
  <?php endif;?>
<script type="text/javascript" src="y-script/script.js"></script>

</body>
</html>

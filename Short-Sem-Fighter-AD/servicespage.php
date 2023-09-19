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
      $createOrder = "INSERT INTO Orders (user_id) VALUES ('{$_SESSION['ID']}');";
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
   <title>Tepi Sungai UTM Service Page</title>
   <link rel='stylesheet' href='css/y-css/navigationbar&body.css'/>
   <?php if($_SESSION['LEVEL']==1):?>
   <link rel='stylesheet' href='css/y-css/serviceSeller.css'/>
   <?php endif;?>
   <?php if($_SESSION['LEVEL']==2||$_SESSION['LEVEL']==0):?>
   <link rel='stylesheet' href='css/y-css/serviceCustomer.css'/>
   <?php endif;?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    body {
      background-image: url('img/backgroundImage/Cart_background.jpg');
      background-size: cover;        
      background-repeat: no-repeat;
      background-attachment: fixed;      
    }
    
    /* Body container */
    .body-container {
      max-width: 900px;
      margin:auto;
      /*padding: 20px;*/
      background-color: rgba(255, 255, 255, 0.6);
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    /* Add spacing between food items */
    .food {
      display: flex;
      align-items: center;
      gap: 20px;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 10px;
      background-color: white;
      transition: transform 0.2s;
      cursor: pointer;
      background-color: #596988;
    }

    .food:hover {
      transform: translateY(-5px);
    }

    /* Food image */
    .food .image {
      max-width: 100px;
      height: 120px;
      width: 120px;
      border-radius: 10px;
    }

    /* Food details */
    .food .details {
      flex: 1;
    }

    /* Food code and name */
    .food .foodId {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 1.3rem;
      font-weight: bold;
      color: #FFFFFF;
    }

    /* Food description */
    .food .engName {
      margin-top: 5px;
      font-weight: bold;
      font-size: 1.2rem;
    }

    /* Food price */
    .food .price {
      margin-top: 10px;
      font-size: 1.2rem;
      color: #f39c12;
    }

    /* Edit and delete buttons */
    .food .buttons {
      display: flex;
      justify-content: space-between;
      align-items: center;
      
      
    }

    /* Edit button */
    .food .editButton {
      background-color: #3498db;
      color: white;
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
      
    }

    
    .food .edit:hover {
      background-color: #2980b9;
    }

    /* Delete button 
    .food .deleteButton {
      background-color: #e74c3c;
      color: white;
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }*/

    .food .delete:hover {
      background-color: #c0392b;
      transform: translateY(-5px);
    }

    /* The middle of the food items */
      .grid-container2 {
        background-color: transparent ;
        
      }

      .categories {
        display: flex;
        justify-content: center;
        background-color: #f5f5f5;
        padding: 10px 0;
        border-radius: 20px;
        font-size: 1.2rem;
        font-weight: bold;
    }

      .categories a {
        text-decoration: none;
        color: #333;
        padding: 10px 20px;
        border-radius: 5px;
        margin: 0 5px;
        transition: background-color 0.2s ease-in-out;
      }

      .categories a:hover {
        background-color: #e0e0e0;
        transform: translateY(-5px);
      }

    /* Active category link */
      .categories a.active {
        background-color: #333;
        color: #ffffff;
      } 

    /* Responsive styles (Can be deleted)*/
    @media screen and (max-width: 768px) {
        .categories {
            flex-direction: column;
            align-items: center;
        }

        .categories a {
            margin: 5px 0;
        }
    }

    .modal-content1 {
      background-color: rgba(89, 105, 136, 0.95);
      color: rgba(255, 255, 255, 0.8);
      padding: 20px;
      border: 5px solid #FFFFFF;
      border-radius: 30px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      width:50%;
      
    }


    /* Input styles for form fields */
    .input-container input[type="text"],
    .input-container input[type="file"],
    .input-container select {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
      border-radius: 5px;
    }

    /* Button styles for the "Add" button */
    .input-container button {
      font-weight: bold;
    }

    .input-container button:hover {
      background-color: #2980b9;
    }

    /* Additional styles for file input */
    .input-container input[type="file"] {
      border: none;
      padding: 10px 0;
    }

    .input-container label {
      display: block;
      font-weight: bold;
      color: white; /* Add this line to set label text color to white */
    }

  </style>
  <script>

function deleteMenu(menuCode) {
  if (confirm("Are you sure you want to delete this item?")) {
    window.location.href = 'operation.php?pass=' + menuCode;
  }
}
</script>


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
        <h1><u>MENU</u></h1>
      </div>

      <div class="date">
        <div><img src="img/servicePageImage/calendar.png" style="height: 30px; width: 30px; margin-right: 10px"></div>
        <div><text style="font-size: 1.1rem;" id="currentDate"><?php echo $today?></text></div>
      </div>
    </div>
    <div class="categories">
      <a href="servicespage.php">All</a>
      <a href="servicespage.php?category=rice">Rice</a>
      <a href="servicespage.php?category=mee">Mee</a>
      <a href="servicespage.php?category=bihun">Bihun</a>
      <a href="servicespage.php?category=alacarte">Ala' Carte</a>
      <a href="servicespage.php?category=beverage">Beverages</a>
      <!-- Add more category tabs here -->
    </div>


      <!-- Display Menu Items -->
    <div class="grid-container2" id="grid-container2">
      <?php
      // Modify your SQL query based on selected category
      $categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Your existing SQL query modification based on sortingAC
          $sort = $_POST['sort'];
          $categoryFilter = $_POST['category'];
      } else {
          // Modify your SQL query to include category filter
          if ($categoryFilter !== '') {
              $sql = "SELECT * FROM Menu WHERE category = '$categoryFilter' ORDER BY menu_code";
          } else {
              $sql = "SELECT * FROM Menu ORDER BY menu_code";
          }
          $res = mysqli_query($conn, $sql);
      }

          if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) { 
              echo "
                <div class='food'>
                  <div class='thumb'>";?>
                    <img class="image" src="img/menuimages/<?=$row['menu_img']?>">
                  
                <?php 
                  echo "</div>
                  <div class='details'>
                  <div class='foodID'> $row[menu_code]   $row[menu_name]</div>
                  <div class='engName'> Description: $row[menu_description] </div>
                  <div class='price'> Price: RM$row[menu_price] </div>
                  <div class='edit allbutton'>
                  <form method='get' action='servicespage.php'>
                    <input name='menucode' type='hidden' value='$row[menu_code]'/>
                    <button type='submit' onclick='display();'class='edit allbutton'>Edit</button>
                  </form>
                </div>                 
                  
                  
                  <button class='delete allbutton' onclick=\"deleteMenu('{$row['menu_code']}')\">Delete</button>

                  </div>
                  </div>";
              } 
            } 
          ?>
    


<?php
  if (isset($_SESSION['alert_message'])) {
    $em = $_SESSION['alert_message'];
    // Clear the session variable
    unset($_SESSION['alert_message']); 
    // Display the alert message
    echo '<script>window.onload = function() { alert("' . $em . '"); }</script>'; 
  }
?>
<button id="plusButton" class="allbutton" onclick="document.getElementById('id01').style.display='block'" style="width:auto;"> + </button>

<div id="id01" class="modal">
  <form class="modal-content1 animate" action="validateUpdateMenu.php" method="post" enctype="multipart/form-data">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <h1>Add Item</h1>
    </div>

    <div class="input-container">

      <label for="foodID"><b>Food's ID</b></label>
      <input type="text" class="foodids" name="menucode" placeholder="" id="foodid" required>

      <label for="foodCname"><b>Food's Name</b></label>
      <input type="text" class="foodCname" name="menuname" placeholder="" required>

      <label for="foodEngName"><b>Food's Description</b></label>
      <input type="text" class="foodEngName" name="menudesc" placeholder="" maxlength="25" required>
        
      <label for="foodPrice"><b>Food Price</b></label>
      <input type="text" class="foodPrice" name="menuprice" placeholder="" required>
      <label for="category"><b>Category</b></label>
      <select name="category" required>
          <option value="all">All</option>
          <option value="rice">Rice</option>
          <option value="mee">Mee</option>
          <option value="bihun">Bihun</option>
          <option value="alacarte">Ala' Carte</option>
          <option value="beverage">Beverage</option>
          <!-- Add more options for other categories -->
      </select>
     
      
      <label for="foodCname"><b>Food's Image: </b></label>
      <input type="file" name="uploadfile" accept="image/jpeg, image/png, image/jpg" required><br><br>
      <button type="submit" name="upload" class="allbutton" id="addButton">ADD</button>  
    </div>
  </form>
</div>


<?php 
  if(isset($_GET['menucode'])):
    $menu_code = $_GET["menucode"];
    unset($_GET["menucode"]);
?>

<div id="id02" class="modal2" >
  <form class="modal-content1 animate" action="operation.php" method="post" enctype="multipart/form-data">
    <div class="imgcontainer">
      <span  onclick="document.getElementById('id02').style.display='none';" class="close" title="Close Modal"><a href="servicespage.php" style="text-decoration: none;">&times;</a></span>
      <h1>Edit Item</h1>
    </div>

  <?php 
    $sql = "SELECT * FROM Menu WHERE menu_code = '$menu_code'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
      while ($row = mysqli_fetch_assoc($res)) { 
        $menu_code = $row["menu_code"];
        $menu_name = $row["menu_name"];
        $menu_price = $row["menu_price"];
        $menu_description = $row["menu_description"];
        $category = $row["category"]; 
      } 
    } 
  ?>
  <div class="input-container">
    <label for="foodID"><b>Food's ID </b></label>
    <input type="text" class="foodids" name="menucode" value="<?php echo $menu_code; ?>" type="hidden" readonly>

    <label for="foodCname"><b>Food's Name</b></label>
    <input type="text" class="foodCname" name="menuname" value="<?php echo $menu_name; ?>">

    <label for="foodEngName"><b>Food's Description</b></label>
    <input type="text" class="foodEngName" name="menudesc" value="<?php echo $menu_description; ?>" maxlength="25">
        
    <label for="foodPrice"><b>Food Price</b></label>
    <input type="text" class="foodPrice" name="menuprice" value="<?php echo $menu_price; ?>">

    <label for="category"><b>Category</b></label>
    <select name="category" required>
        <option value="rice" <?php if ($category == 'rice') echo 'selected'; ?>>Rice</option>
        <option value="mee" <?php if ($category == 'mee') echo 'selected'; ?>>Mee</option>
        <option value="bihun" <?php if ($category == 'bihun') echo 'selected'; ?>>Bihun</option>
        <option value="alacarte" <?php if ($category == 'alacarte') echo 'selected'; ?>>Ala' Carte</option>
        <option value="beverage" <?php if ($category == 'beverage') echo 'selected'; ?>>Beverage</option>
        <!-- Add more options for other categories -->
    </select>

    <label for="foodCname"><b>Food's Image: </b></label>
    <input type="file" name="uploadfile" accept="image/jpeg, image/png, image/jpg" class="menuimg"><br><br>

    <button type="submit" name="upload" class="allbutton" id="addButton">Edit</button>
      
    </div>
    
    <?php
      if (isset($_SESSION['alert_message'])) {
        $em = $_SESSION['alert_message'];
        // Clear the session variable
        unset($_SESSION['alert_message']); 
        // Display alert message
        echo '<script>window.onload = function() { alert("' . $em . '"); }</script>'; 
      }
    ?>
  </form>
</div>
<?php endif;?>
</div></div> 
  <?php endif;?>

  <?php if($_SESSION['LEVEL']==2||$_SESSION['LEVEL']==0):?>
    
  <div class="body-container">
    <div>
    <div class="grid-container">
      <div class="editMenu">
        <h1><u>MENU</u></h1>
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
        <a data-active="cart" href="cart.php"><img src="img/shopping-cart.png" style="height: 40px; width: 40px; margin-right: 10px"></a></i>
      </div>

    </div>
    <div class="categories">
      <a href="servicespage.php">All</a>
      <a href="servicespage.php?category=rice">Rice</a>
      <a href="servicespage.php?category=mee">Mee</a>
      <a href="servicespage.php?category=bihun">Bihun</a>
      <a href="servicespage.php?category=alacarte">Ala' Carte</a>
      <a href="servicespage.php?category=beverage">Beverages</a>
    </div>

     <div class="grid-container2" id="grid-container2">
      <?php
      $categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sort = $_POST['sort'];
        $categoryFilter = isset($_POST['category']) ? $_POST['category'] : 'all';

    
        if ($categoryFilter !== 'all') {
            if ($sort === 'menu_name') {
                // Sort by menu name
                $sql = "SELECT * FROM Menu WHERE category = '$categoryFilter' ORDER BY menu_name";
            } elseif ($sort === 'menu_price') {
                // Sort by menu price
                $sql = "SELECT * FROM Menu WHERE category = '$categoryFilter' ORDER BY menu_price";
            }
        } else {
            if ($sort === 'menu_name') {
                // Sort by menu name
                $sql = "SELECT * FROM Menu ORDER BY menu_name";
            } elseif ($sort === 'menu_price') {
                // Sort by menu price
                $sql = "SELECT * FROM Menu ORDER BY menu_price";
            }
        }
    } else {
        if ($categoryFilter !== '') {
            $sql = "SELECT * FROM Menu WHERE category = '$categoryFilter' ORDER BY menu_code";
        } else {
            $sql = "SELECT * FROM Menu ORDER BY menu_code";
        }
    }
    
    $res = mysqli_query($conn, $sql);
      

          if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) { 
                  
                echo "
                <form method='post' action='updateOrder.php'>
                <div class='food'>
                <div class='images'>";
        ?>

          <img class="picturesize" src="img/menuimages/<?=$row['menu_img']?>">
            
          <?php 
            echo "</div>
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
            } 
          } 
        ?>
          
        </div>
      </div>
<?php
if (isset($_SESSION['alert_message'])) {
  $em = $_SESSION['alert_message'];
  // Clear the session variable
  unset($_SESSION['alert_message']); 
  // Display the alert message
  echo '<script>window.onload = function() { alert("' . $em . '"); }</script>'; 
}?>

      
  </div> 
 
  <?php endif;?>
<script type="text/javascript" src="y-script/script.js"></script>

</body>
</html>
<?php
// Start up your PHP Session
session_start();

include("config.php");

if ($_SESSION["Login"] != "YES") {
	header("Location: login.php");
}
?>
<html>
    <head>
        <title>Tepi Sungai UTM Home Page</title>
        <link rel='stylesheet' href='css/y-css/navigationbar&body.css'/>
        <link rel="stylesheet" href="mainPage.css">
    </head>

    <body>
          <?php
          include("header.php");
          ?>

        <div class="outside">
          <div class="grid-container">
            <div class="oneTwo">
            <div class="one">
    <h1>Tepi Sungai</h1><br><br>
    <p>Food Ordering System </p>
    <p>for all UTMians</p><br><br>
    
<?php
    if ($_SESSION['LEVEL'] == 1) {
        echo "<div id='visitor-count'>";
            // Check if the visitor count cookie exists
            if (isset($_COOKIE['visitor_count'])) {
                $count = $_COOKIE['visitor_count'];
                echo $count. " person visited your website today";
                echo nl2br("\n");
                echo nl2br("\n");
            } else {
                echo "No visitor yet ";
                echo nl2br("\n");
                echo nl2br("\n");
            }

        
            echo "</div>";
        echo "<a class='btn signUpNow' href='servicespage.php'>EDIT NOW</a>";
    } else {
        echo "<a class='btn signUpNow' href='servicespage.php'>Start Order</a>";
    }
    ?>
</div>
              <div class="two">
                  <img src="img\homepage.jpg "style =" height: 300px; width: 400px;"  class="image1">
              </div>
            </div>
            <div class="three">
                <img src="img/bghomepage.jpg"style =" height: 1000px;" class="image2">
            </div>
            <div class="four">
                <br><br><br>
                <p>Good food within minutes</p>
                <p>Your favourite food delivery partner</p>
                <p>The food of your choice</p>
            </div>
          </div>
        </div>
    </body>

</html>
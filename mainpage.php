<?php
// Check if the visitor count cookie exists
if (!isset($_COOKIE['visitor_count'])) {
    // Create a new cookie with an initial count of 1
    $count = 1;
    setcookie('visitor_count', $count, time() + 86400); // Expires in 24 hours
} else {
    // Increment the visitor count by 1
    $count = $_COOKIE['visitor_count'] + 1;
    setcookie('visitor_count', $count, time() + 86400); // Expires in 24 hours
}
?>
<html>
    <head>
        <title>Jojoe Food</title>
        <link rel='stylesheet' href='css/y-css/navigationbar&body.css'/>
        <link rel="stylesheet" href="mainPage.css">
    </head>

    <div class='menu-container'>
            <div class='menu'>
              <div class ='left_menu'>
                  <div class="logo">
                    <img src="img\headerImage\TS-removebg-preview 2.png" style="height: 60px; width: 100px; text-align: center">
                  </div>   
                    <div class="headermain"><a data-active="home" href="mainpage.php" >HOME</a></div> 
              </div>
                <div class="login">
                    <img src="img/headerImage/image.png" style="text-align: center; padding: 15px 0;">
          <a href="login.php">LOGIN</a>
      </div>          
    </div>
</div>

        <div class="outside">
            <div class="grid-container">
            <div class="oneTwo">
                    <div class="one">
                        <h1>Tepi Sungai UTM</h1><br><br>
                        <p>a food ordering system</p>
                        <p>for all UTMians</p><br><br>
                        <button class="btn signUpNow" onclick="location.href='register.php'">SIGN UP NOW</a></button>
                    </div>
                    <div class="two">
                        <img src="img/image/platefood.png" class="image1">
                    </div>
            </div>
                <div class="three">
                    <img src="img/image/cendolbanner.png" class="image2">
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
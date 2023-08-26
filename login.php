<html>
<head>
<?php
session_start();

// If the user is not logged in send him/her to the login form
if(isset($_SESSION["Login"])){
if ($_SESSION["Login"] == "NO") {
  echo '<script>window.onload = function() { alert("Invalid login"); }</script>'; // Display the alert message

}

unset($_SESSION["Login"]);}


?>

<html>
<head>
<title>Jojoe food ordering system login page</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
<link rel='stylesheet' href='css/y-css/navigationbar&body.css'/>
<link rel="stylesheet" type="text/css" href="css/ks-css/style2.css" id="stylesheet">
<script>
    function isNumberKey(event) {
      var charCode = (event.which) ? event.which : event.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
      }
      return true;
    }
        
    
    function resetPwd() {
    var email = prompt("Please enter your email address:");

     if (email) {
      if (!isValidEmail(email)) {
      alert("Please enter a valid email address.");
        return;
      }

      var resetUrl = "https://example.com/reset-password?email=" + encodeURIComponent(email);
      window.location.href = resetUrl;
  }
}

function isValidEmail(email) {
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}
    </script>
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

  <div class="container">
        <div class="leftcontainer">
            <form method="post" action="check_login.php">
                <p class="logina">LOGIN </p>
                <p class="userid">User ID: <br>
                <input class="inputtype" type="text" name="username" size="30", placeholder="Enter your user ID" maxlength="10"><br></p>                               
                <p class="password">Password: <br>
                <input class="inputtype" type="password" name="password" size="30", placeholder="Enter your password" maxlength="10"></p>              
               <p class="loginbutton">
                <input class="inputtype" type="submit" name="login" id="login"value="Login"></p></form>
                <div class="line-container">
                  <hr class="line">
                  <span class="line-text">Or</span>
                  <hr class="line">
                </div>
              <p class="signup"> Don't have an account? <a href="signup.php">Sign Up Now</a> </p> <!-- link to sign up page-->


        </div>
        <div class="rightcontainer">
          <div class="foodcontainer" ><img class="foodlogo" src="img/image/platefood.png">
            <h1>Tepi Sungai UTM</h1></div>
    </div>

</body>
</html>
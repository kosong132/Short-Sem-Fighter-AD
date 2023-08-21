<?php
session_start();

if(isset($_POST["username"])&&isset($_POST["userid"])&&isset($_POST["email"])&&isset($_POST["matric"])&&isset($_POST["phone"])&&isset($_POST["password"])&&isset($_POST["address"])){
// Q1: get all fieldnames using $_POST
 $userName = $_POST["username"];
 $userId = $_POST["userid"];
 $email = $_POST["email"];
 $matric = $_POST["matric"];
 $phone = $_POST["phone"];
 $password = $_POST["password"];
 $address= $_POST["address"];

//Q2: call config.php to open connection to database before performing insert data
require_once('config.php');

//Q3: input all fieldnames into table myguests using INSERT INTO 
$sql = "INSERT INTO Users(user_id,user_name,user_email,user_matricno,user_phonenumber,user_password,user_address,user_level) VALUES ('$userId','$userName','$email','$matric','$phone','$password','$address',0)";

if (mysqli_query($conn, $sql)) {
    $_SESSION['USER'] = $userName;
    $_SESSION['ID'] = $userId;
    $_SESSION['LEVEL'] = 0;
    $_SESSION["Login"] = "YES";
    header("Location: homepage.php");
} else {
  $em= "Duplicate userid!  Sign up failed";
    echo '<script>window.onload = function() { alert("' . $em . '"); }</script>'; // Display the alert message
  
}}
?>
<html>
<head>
<title>Jojoe food ordering system sign up page</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/ks-css/style1.css" id="stylesheet">
<link rel='stylesheet' href='css/y-css/navigationbar&body.css'/>
<script>
    function isNumberKey(event) {
      var charCode = (event.which) ? event.which : event.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
      }
      return true;
    }
    function validateUserID(input) {
    const value = input.value.trim();

    if (/\s/.test(value)) {
      input.setCustomValidity('Spaces are not allowed in the User ID.');
    } else {
      input.setCustomValidity('');
    }
  }
  function validateEmail(input) {
    const value = input.value.trim();

    if (!isValidEmail(value)) {
      input.setCustomValidity('Please enter a valid email address.');
    } else {
      input.setCustomValidity('');
    }
  }

  function isValidEmail(email) {
    // Regular expression pattern to validate email address
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
  }
    </script>
</head>
<body> 
<div class='menu-container'>
            <div class='menu'>
              <div class ='left_menu'>
                  <div class="logo">
                    <img src="img/headerImage/image (1).png" style="height: 50px; width: 50px; text-align: center">
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
        <form method="post" action="signup.php">
                <p class="signup">SIGN UP</p>
                
                <p class="username">Username: <br>
                <input class="inputtype" type="text" name="username" size="30", placeholder="Enter a username" maxlength="20" required ><br></p>
                <p class="userid">User ID: <br>
                  <input class="inputtype" type="text" name="userid" size="30", placeholder="Enter a userid" maxlength="10"  oninput="validateUserID(this)" required ><br></p>
                  <span id="userid-error" class="error-msg"></span>
                  <p class="emailaddress"> Email Address: <br>
                <input class="inputtype" type="text" name="email" size="30", placeholder="Enter your email address" maxlength="30"oninput="validateEmail(this)"required ><br></p>
                <p class="matricno">Matric Number: <br>
                <input class="inputtype" type="text" name="matric" size="30", placeholder="Enter your matricno" maxlength="10"required ><br></p>
                <p class="address" >Address: <br>
                <input class="inputtype" type="text" name="address" size="30", placeholder="Enter your address" required><br></p>
                <p class="phonenumber" >Phone Number: <br>
                <input class="inputtype" type="text" name="phone" size="30", placeholder="Enter your phone number" maxlength="15" onkeypress="return isNumberKey(event)"required ><br></p>
                <p class="password">Password: <br>
                <input class="inputtype" type="password" name="password" size="30", placeholder="Enter your password" maxlength="10"required ><br></p>
                
                <p class="button"><input class="inputtype" type="submit" name="signup" value="Sign Up" id="signup"><br></p>
            </form>
            
        </div>
        <div class="rightcontainer">
        <div class="foodcontainer" ><img class="foodlogo" src="img/image/platefood.png">
            <h1>Jojoe Food</h1></div>
        </div>
    </div>


</body>
</html>

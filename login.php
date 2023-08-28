<?php
session_start();

// If the user is not logged in send him/her to the login form
if (isset($_SESSION["InvalidLogin"]) && $_SESSION["InvalidLogin"] === true) {
    echo '<script>alert("Invalid login");</script>';
    unset($_SESSION["InvalidLogin"]);
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="login-style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body style="background-image: url('images/food.png');">
    <div class="menu-bar">
        <div class="logo"><img src="images/logo.png" alt="logo" width="150px" height="70px"></div>
        <div class="menu-options">
            <a href="mainpage.php">HOME</a>
            <a href="login.php">LOGIN</a>
        </div>
    </div>

    <h2 class="login-heading">Welcome back!</h2>

    <div class="login-container">
        <form action="login_process.php" method="post">
            <div class="form-group">
                <label for="userID">User ID:</label>
                <input type="text" name="userID" id="userID" placeholder="Enter your User ID" required>
            </div>
            <div class="form-group">
                <br>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
            </div>
            <br>
            <input type="submit" value="LOGIN">
        </form>
    </div>

    <div class="login-options">
        <p>Don't have an account? <a href="register.php">Sign up now</a></p>
    </div>
</body>
</html>
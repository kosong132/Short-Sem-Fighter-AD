<?php
session_start();

if (isset($_POST["userID"])&&isset($_POST["userName"])&&isset($_POST["password"])&&isset($_POST["email"])&&isset($_POST["phone"])&&isset($_POST["address"])) {
    $userName = $_POST["userName"];
    $userID = $_POST["userID"];
    $pwd = $_POST["password"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    require_once "config.php";
    // Check if userID is already taken

    $sql = "INSERT INTO Users(user_id,user_name,user_password,user_level,user_email,user_phonenumber,user_address) VALUES ('$userID','$userName','$pwd',0,'$email','$phone','$address')";

    if (mysqli_query($conn, $sql)) {
    $_SESSION['USER'] = $userName;
    $_SESSION['ID'] = $userID;
    $_SESSION['LEVEL'] = 0;
    $_SESSION["Login"] = "YES";
    header("Location: homepage.php");
    } else {
     $em= "Duplicate userid!  Sign up failed";
    echo '<script>window.onload = function() { alert("' . $em . '"); }</script>'; // Display the alert message
  
}}
   

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tepi Sungai Food Ordering System Registration Page</title>
    <link rel="stylesheet" type="text/css" href="register-style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            //Logout button, just for testing purpose, can delete after that
            const logoutBtn = document.getElementById("logoutBtn");
            const logoutModal = document.getElementById("logoutModal");
            const closeModal = document.getElementById("closeModal");
            const confirmLogout = document.getElementById("confirmLogout");

            logoutBtn.addEventListener("click", function() {
                logoutModal.style.display = "block";
            });

            closeModal.addEventListener("click", function() {
                logoutModal.style.display = "none";
            });

            confirmLogout.addEventListener("click", function() {
                // Perform logout action
                // For example, redirect to logout page or execute logout API
                 window.location.href = "mainpage.php";
            });

            //Validate Confirm password and password length
            const passwordField = document.getElementById("password");
            const confirmPasswordField = document.getElementById("confirmPassword");
            const confirmPasswordError = document.getElementById("confirmPasswordError");
            const passwordLengthError = document.getElementById("passwordLengthError");

            function validatePasswordLength() {
                if (passwordField.value.length < 6) {
                    passwordLengthError.textContent = "Password must be at least 6 character.";
                    passwordField.setCustomValidity("Password must be at least 6 character.");
                } else {
                    passwordLengthError.textContent = "";
                    passwordField.setCustomValidity("");
                }
            }

            function validateConfirmPassword() {
                if (passwordField.value !== confirmPasswordField.value) {
                    confirmPasswordError.textContent = "Passwords do not match.";
                    confirmPasswordField.setCustomValidity("Passwords do not match.");
                    confirmPasswordError.style.display = "block";
                } else {
                    confirmPasswordError.textContent = "";
                    confirmPasswordField.setCustomValidity("");
                    confirmPasswordError.style.display = "none";
                }
            }

            passwordField.addEventListener("input", validatePasswordLength);
            passwordField.addEventListener("input", validateConfirmPassword);
            confirmPasswordField.addEventListener("input", validateConfirmPassword);

            <?php
            if ($registrationSuccess) {
                echo 'alert("Registration successful! You can now log in.");';
            }
            ?>
        });

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
<body style="background-image: url('images/food.png');">
    <div class="menu-bar">
        <div class="logo"><img src="images/logo.png" alt="logo" width="150px" height="70px"></div>
        <div class="menu-options">
            <a href="#" id="logoutBtn">LOG OUT</a>
            <a href="login.php">LOGIN</a>
        </div>
    </div>

    <div id="logoutModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Logout Confirmation</h2>
            <p>Are you sure you want to logout?</p> <br>
            <button id="confirmLogout"><b>Yes, Logout</b></button>
        </div>
    </div>

    <h2 class="register-heading">Create an Account</h2>

    <div class="register-container">
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="userName">Username:</label>
                <input type="text" name="userName" id="userName" placeholder="Enter your Username" required>
            </div>
            <div class="form-group">
                <label for="userID">User ID:</label>
                <input type="text" name="userID" id="userID" placeholder="Enter your User ID" oninput="validateUserID(this)" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter your Password" required>
                <div id="passwordLengthError" class="error-dialog"></div>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm your Password" required>
                <div id="confirmPasswordError" class="error-dialog"></div>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" name="email" id="email" placeholder="Enter your Email Address" oninput="validateEmail(this)" required>
            </div>
            <div class="form-group">
                <label for="address">Residential Address:</label>
                <input type="text" name="address" id="address" placeholder="Enter your Address" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" name="phone" id="phone" placeholder="Enter your Phone Number" onkeypress="return isNumberKey(event)" required>
            </div>
            <input type="submit" value="REGISTER">
        </form>
    </div>

    <div class="register-options">
        <p>Already have an account? <a href="login.php">Login now</a></p>
    </div>
</body>
</html>

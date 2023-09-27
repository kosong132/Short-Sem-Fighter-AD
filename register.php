<?php
session_start();
require_once "config.php";

// Check if registration success session variable is set
$registrationSuccess = isset($_SESSION["registrationSuccess"]) ? $_SESSION["registrationSuccess"] : false;

// Clear the registration success session variable after use
unset($_SESSION["registrationSuccess"]);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tepi Sungai Food Ordering System Registration Page</title>
    <link rel="stylesheet" type="text/css" href="register-style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            //Validate Confirm password
            const passwordField = document.getElementById("password");
            const confirmPasswordField = document.getElementById("confirmPassword");
            const confirmPasswordError = document.getElementById("confirmPasswordError");

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

            passwordField.addEventListener("input", validateConfirmPassword);
            confirmPasswordField.addEventListener("input", validateConfirmPassword);

           
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

    function showAlertOnSuccess() {
    const passwordField = document.getElementById("password");
    const confirmPasswordField = document.getElementById("confirmPassword");

    // Check if passwords match
    const passwordsMatch = passwordField.value === confirmPasswordField.value;

    if (passwordsMatch) {
        // Registration is successful, show the alert
        alert("Registration successful! You can now log in.");
        return true; // Allow the form submission to proceed
    } else {
        // Passwords don't match, prevent form submission
        alert("Passwords do not match. Please check and try again.");
        return false; // Prevent form submission
    }
}

    </script>
</head>
<body style="background-image: url('images/food.png');">
    <div class="menu-bar">
        <div class="logo"><img src="images/logo.png" alt="logo" width="150px" height="70px"></div>
        <div class="menu-options">
            <a href="mainpage.php">HOME</a>
            <a href="login.php">LOGIN</a>
        </div>
    </div>

    <h2 class="register-heading">Create an Account</h2>

    <div class="register-container">
        <form action="register_process.php" method="post" onsubmit="return showAlertOnSuccess()">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Enter your Username" required>
            </div>
            <div class="form-group">
                <label for="userID">User ID:</label>
                <input type="text" name="userID" id="userID" placeholder="Enter your User ID" oninput="validateUserID(this)" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter your Password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm your Password" required>
                <div id="confirmPasswordError" class="error-dialog"></p>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" name="email" id="email" placeholder="Enter your Email Address" oninput="validateEmail(this)" required>
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
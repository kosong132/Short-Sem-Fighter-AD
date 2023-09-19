<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $userID = $_POST["userID"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Check if userID is already taken
    $checkQuery = "SELECT * FROM Users WHERE user_id = '$userID'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo '<script>alert("User ID is already taken. Please choose a different one."); window.location = "register.php";</script>';
    } else {
        // Insert user data into database
        $insertQuery = "INSERT INTO users (user_name, user_id, user_password, user_level, user_email, user_phonenumber) VALUES ('$username', '$userID', '$password', 0, '$email', '$phone')";

        if (mysqli_query($conn, $insertQuery)) {
            $_SESSION["registrationSuccess"] = true;
            $_SESSION['USER'] = $username;
            $_SESSION['ID'] = $userID;
            $_SESSION['LEVEL'] = 0;
            $_SESSION["Login"] = "YES";
            header("location: register.php");
        } else {
            echo '<script>alert("Error: ' . mysqli_error($conn) . '"); window.location = "register.php";</script>';
        }
    }
}
?>

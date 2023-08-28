<?php
$servername = "localhost";
$username = "kk";
$password = "jingjie02";
$database = "tepi_sungai";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL command to create the users table
$sql = "CREATE TABLE Users (
    userID VARCHAR(20) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    userLevel INT(3) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    order_counter INT(10),
    CONSTRAINT user_pk PRIMARY KEY(userID))";

if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>

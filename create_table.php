<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tepi_sungai";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create Users table
$users = "CREATE TABLE Users (
    user_id VARCHAR(20) NOT NULL UNIQUE,
    user_name VARCHAR(50) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_level INT(3) NOT NULL,
    user_email VARCHAR(100) NOT NULL,
    user_phonenumber VARCHAR(15) NOT NULL,
    user_address VARCHAR(30),
    order_counter INT(10),
    CONSTRAINT user_pk PRIMARY KEY(user_id)
)";

// Create Menu table
$menu = "CREATE TABLE Menu (
    menu_img MEDIUMBLOB NOT NULL,
    menu_code VARCHAR(10) NOT NULL,
    menu_name VARCHAR(30) NOT NULL,
    menu_price FLOAT(8) NOT NULL,
    menu_description VARCHAR(200) NOT NULL,
    category VARCHAR(20) NOT NULL,
    CONSTRAINT menu_pk PRIMARY KEY(menu_code)
)";

// Create Orders table
$order = "CREATE TABLE Orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(20) NOT NULL,
    payment_status VARCHAR(15) DEFAULT 'PENDING',
    payment_date DATETIME DEFAULT NULL,
    total_price FLOAT(8) NOT NULL,
    order_type VARCHAR(15),
    order_time_slot VARCHAR(50),
    payment_method VARCHAR(50),
    preparing_status VARCHAR(255) DEFAULT 'Preparing',
    CONSTRAINT user_fk FOREIGN KEY(user_id) REFERENCES Users(user_id)
)";

// Create ConfirmedOrders table
$cf = "CREATE TABLE ConfirmedOrders (
    confirmed_order_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT(10) NOT NULL,
    user_id VARCHAR(20) NOT NULL,
    payment_status VARCHAR(15) NOT NULL,
    payment_date DATETIME,
    total_price FLOAT(8) NOT NULL,
    order_type VARCHAR(15),
    order_time_slot VARCHAR(50),
    payment_method VARCHAR(50),
    CONSTRAINT order_fk_confirmed FOREIGN KEY(order_id) REFERENCES Orders(order_id)
)";

// Create Orderdetails table
$orderdetail = "CREATE TABLE Orderdetails (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT(10) NOT NULL,
    menu_code VARCHAR(10) NOT NULL,
    order_quantity INT(4) NOT NULL,
    order_price FLOAT(8) NOT NULL,
    CONSTRAINT order_fk FOREIGN KEY(order_id) REFERENCES Orders(order_id),
    CONSTRAINT od_fk FOREIGN KEY(menu_code) REFERENCES Menu(menu_code)
)";

// Execute the create table queries
if (mysqli_query($conn, $users)) {
    echo "Table Users created successfully";
} else {
    echo "Error creating table Users: " . mysqli_error($conn);
}

if (mysqli_query($conn, $menu)) {
    echo "Table Menu created successfully";
} else {
    echo "Error creating table Menu: " . mysqli_error($conn);
}

if (mysqli_query($conn, $order)) {
    echo "Table Orders created successfully";
} else {
    echo "Error creating table Orders: " . mysqli_error($conn);
}

if (mysqli_query($conn, $cf)) {
    echo "Table ConfirmedOrders created successfully";
} else {
    echo "Error creating table ConfirmedOrders: " . mysqli_error($conn);
}

if (mysqli_query($conn, $orderdetail)) {
    echo "Table Orderdetails created successfully";
} else {
    echo "Error creating table Orderdetails: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>

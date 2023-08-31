<?php
    //3
    $conn = mysqli_connect("localhost","root","");
    if(!$conn){
        die("Could not connect: " . mysqli_connect_error());
    }

    //Select database
    mysqli_select_db($conn, "updatedcategoryfoodorder");

    //Create table
    $user = "CREATE TABLE Users(
        user_id VARCHAR(10) NOT NULL,
        user_email VARCHAR(40),
        user_name VARCHAR(30),
        user_phonenumber VARCHAR(12),
        user_matricno VARCHAR(10),
        user_address VARCHAR(30),
        user_level INT(3) NOT NULL,
        user_password VARCHAR(20) NOT NULL,
        order_counter INT(10),
        CONSTRAINT user_pk PRIMARY KEY(user_id))";

    $menu = "CREATE TABLE Menu(
        menu_img MEDIUMBLOB NOT NULL,
        menu_code VARCHAR(10) NOT NULL,
        menu_name VARCHAR(30) NOT NULL,
        menu_price FLOAT(8) NOT NULL,
        menu_description VARCHAR(200) NOT NULL,
        category VARCHAR(20) NOT NULL,
        CONSTRAINT menu_pk PRIMARY KEY(menu_code))";

    $order = "CREATE TABLE Orders(
    order_id INT(10) AUTO_INCREMENT,
    user_id VARCHAR(10) NOT NULL,
    payment_status VARCHAR(15) NOT NULL,
    payment_date DATETIME NOT NULL,
    total_price FLOAT(8) NOT NULL,
    CONSTRAINT orderid_pk PRIMARY KEY(order_id,user_id),
    CONSTRAINT user_fk FOREIGN KEY(user_id) REFERENCES Users(user_id))";


    $orderdetail = "CREATE TABLE Orderdetails(
        item_id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT(10) NOT NULL,
        menu_code VARCHAR(10) NOT NULL,
        order_quantity INT(4) NOT NULL,
        order_price FLOAT(8) NOT NULL,
        CONSTRAINT order_fk FOREIGN KEY (order_id) REFERENCES Orders(order_id) ON DELETE CASCADE,
        CONSTRAINT od_fk FOREIGN KEY (menu_code) REFERENCES Menu(menu_code) ON DELETE CASCADE)";



    if (mysqli_query($conn, $user)) {
        echo "Table Users created successfully";
    } else {
        echo "Error creating table: " . mysqli_connect_error($conn);
    }

    if (mysqli_query($conn, $menu)) {
        echo "Table Menu created successfully";
    } else {
        echo "Error creating table: " . mysqli_connect_error($conn);
    }

    if (mysqli_query($conn, $order)) {
        echo "Table Order created successfully";
    } else {
        echo "Error creating table: " . mysqli_connect_error($conn);
    }

    if (mysqli_query($conn, $orderdetail)) {
        echo "Table Orderdetails created successfully";
    } else {
        echo "Error creating table: " . mysqli_connect_error($conn);
    }

    //Close connection
    mysqli_close($conn);
?>
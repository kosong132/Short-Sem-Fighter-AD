<?php

$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername,$username,$password);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (!mysqli_select_db($conn, 'foodorder')){
$sql = "CREATE DATABASE foodorder";
if (mysqli_query($conn, $sql)) {
  echo "Database FoodOrder created successfully";
} else {
  echo "Error creating database: " . mysqli_error($conn);
  header("Location: mainpage.php");
}


mysqli_select_db($conn, "foodorder");

$user = "CREATE TABLE user(
    user_id VARCHAR(10) NOT NULL,
    user_email VARCHAR(40),
    user_name VARCHAR(30),
    user_phonenumber VARCHAR(12),
    user_matricno VARCHAR(10),
    user_address VARCHAR(200),
    user_level INT(3) NOT NULL,
    user_password VARCHAR(20) NOT NULL,
    order_counter INT(10),
    CONSTRAINT user_pk PRIMARY KEY(user_id))";

$menu = "CREATE TABLE menu(
    menu_img MEDIUMBLOB NOT NULL,
    menu_code VARCHAR(10) NOT NULL,
    menu_name VARCHAR(30) NOT NULL,
    menu_price FLOAT(8) NOT NULL,
    menu_description VARCHAR(200) NOT NULL,
    CONSTRAINT menu_pk PRIMARY KEY(menu_code))";

$order = "CREATE TABLE orders(
  order_id INT(10) AUTO_INCREMENT,
  user_id VARCHAR(10) NOT NULL,
  payment_status VARCHAR(15) NOT NULL,
  payment_date DATETIME NOT NULL,
  total_price FLOAT(8) NOT NULL,
  CONSTRAINT orderid_pk PRIMARY KEY(order_id,user_id),
  CONSTRAINT user_fk FOREIGN KEY(user_id) REFERENCES user(user_id))";


$orderdetail = "CREATE TABLE orderdetail(
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT(10) NOT NULL,
    menu_code VARCHAR(10) NOT NULL,
    order_quantity INT(4) NOT NULL,
    order_price FLOAT(8) NOT NULL,
    CONSTRAINT order_fk FOREIGN KEY (order_id) REFERENCES orders(order_id),
    CONSTRAINT od_fk FOREIGN KEY (menu_code) REFERENCES menu(menu_code))";



if (mysqli_query($conn, $user)) {
    echo "Table user created successfully";
  } else {
    echo "Error creating table: " . mysqli_error($conn);
  }

if (mysqli_query($conn, $menu)) {
    echo "Table menu created successfully";
  } else {
    echo "Error creating table: " . mysqli_error($conn);
  }

if (mysqli_query($conn, $order)) {
    echo "Table order created successfully";
  } else {
    echo "Error creating table: " . mysqli_error($conn);
  }

if (mysqli_query($conn, $orderdetail)) {
    echo "Table orderdetail created successfully";
  } else {
    echo "Error creating table: " . mysqli_error($conn);
  }

  $sql = "insert into user(user_id, user_password, user_level , user_name) values ('Tepisungai','pass1',1,'Tepi Sungai')";
		 if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
    
mysqli_close($conn);}
header("Location: mainpage.php")
?>
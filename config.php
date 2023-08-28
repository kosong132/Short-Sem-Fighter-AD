<?php
$host = "localhost";
$username = "kk";
$password = "jingjie02";
$database = "tepi_sungai";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

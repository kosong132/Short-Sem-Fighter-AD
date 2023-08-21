<?php
//2
$conn = mysqli_connect("localhost","root","");
if(!$conn){
    die("Could not connect: " . mysqli_connect_error());
}

if(mysqli_query($conn,"CREATE DATABASE foodorder")){
    echo "Database created";
}else{
    echo "Error creating database: " . mysqli_connect_error();
}
mysqli_close($conn);
?>
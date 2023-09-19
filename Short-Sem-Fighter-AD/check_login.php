<?php 
// Start up your PHP Session
session_start();

include('config.php');
if(isset($_POST['logout'])){

	if (isset($_SESSION['USER'])) 
	{   
		if($_SESSION['LEVEL'] == 0){
			$sql = "UPDATE Users SET order_counter={$_SESSION['COUNTER']},user_level = 2 WHERE user_id = '{$_SESSION['ID']}'";
			mysqli_query($conn,$sql);
		}
		else if($_SESSION['LEVEL'] == 2){
			$sql = "UPDATE Users SET order_counter={$_SESSION['COUNTER']} WHERE user_id = '{$_SESSION['ID']}'";
			mysqli_query($conn,$sql);
		}
		
		unset($_SESSION['USER']); 
	} 
	session_destroy(); //destroy the session

	header("Location: login.php");
	
	// go to login page 
	exit;
}
else{
// username and password sent from form login.php
$myusername=$_POST['username'];
$mypassword=$_POST['password'];

$sql="SELECT * FROM Users WHERE user_id='$myusername' AND user_password='$mypassword'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) 
	{
		$user_name = $row["user_name"];
		$user_id = $row["user_id"];
		$user_level = $row["user_level"];
	}
}

// mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
		
$_SESSION["Login"] = "YES";
 
// Add user information to the session (global session variables)
$_SESSION['USER'] = $user_name;
$_SESSION['ID'] = $user_id;
$_SESSION['LEVEL'] = $user_level;


if ($_SESSION['LEVEL']==2){
	$sql = "SELECT * FROM Users WHERE user_id = '{$_SESSION['ID']}'";
	$res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) { 
			$_SESSION['COUNTER']= $row['order_counter'];
		}
}
}

header("Location: homepage.php");}

//if wrong username and password
else {

$_SESSION["Login"] = "NO";
header("Location: login.php");

}}

?>
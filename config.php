<?php 

    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'updatedcategoryfoodorder';

    //login to MySQL Server from PHP
    $conn = mysqli_connect($db_host, $db_user, $db_pass);

     // If login failed, terminate the page (using function 'die')
     if (!$conn) die("Error! Cannot connect to server: ". mysqli_connect_error() );

     // Login was successful. Then choose a database to work with (change to your own database)
	 $selected = mysqli_select_db($conn, $db_name);

	// If required database cannot be used, terminate the page
	if (!$selected) die ("Cannot use database: " . mysqli_connect_error() );

?>
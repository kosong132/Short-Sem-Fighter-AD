<html>
    <head>
        <title>Insert User Data</html>
    </head>
    <body>
        <?php
            $conn = mysqli_connect("localhost","root","");
            if(!$conn){
                die("Could not connect: " . mysqli_connect_error());
            }

            //Select database
            mysqli_select_db($conn, "tepi_sungai");

            //Insert data to table
            mysqli_query($conn, "INSERT INTO Users(user_id, user_password, user_level , user_name) VALUES ('kengkeat','pass1',1,'Ng Keng Keat')");
            mysqli_query($conn, "INSERT INTO Users(user_id, user_password, user_level , user_name) VALUES ('sengsoon','pass2',1,'Phang Seng Soon')");
            mysqli_query($conn, "INSERT INTO Users(user_id, user_password, user_level , user_name) VALUES ('koksiong','pass3',1,'Yong Kok Siong')");
    

            //Close connection
            mysqli_close($conn);
        ?>
        <br><br> <b>Insertion was successful</b> <br><br>
    </body>
</html>



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
            mysqli_query($conn, "INSERT INTO Users(user_id, user_password, user_level , user_name) VALUES ('ks1118','aassdd',0,'Yong Kok Siong')");
            mysqli_query($conn, "INSERT INTO Users(user_id, user_password, user_level , user_name) VALUES ('kss','aassdd',0,'Kok Siong')");
            mysqli_query($conn, "INSERT INTO OrderDetails(menu_image, menu_code, menu_name,menu_price ,menu_description, category) VALUES ('img\menuimages\IMG-64e2dd7b4bd4c0.85093403.png','B01','NasiGoreng',3,'abc','Rice')");
            //Close connection
            mysqli_close($conn);
        ?>
        <br><br> <b>Insertion was successful</b> <br><br>
    </body>
</html>



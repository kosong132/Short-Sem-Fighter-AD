<html>
    <head>
        <title>Insert User Data</html>
    </head>
    <body>
        <?php
            $conn = mysqli_connect("localhost","kk","jingjie02");
            if(!$conn){
                die("Could not connect: " . mysqli_connect_error());
            }

            //Select database
            mysqli_select_db($conn, "tepi_sungai");

            //Insert data to table
            mysqli_query($conn, "INSERT INTO Users(userID, password, userLevel , username) VALUES ('kengkeat','pass1',1,'Ng Keng Keat')");
            mysqli_query($conn, "INSERT INTO Users(userID, password, userLevel , username) VALUES ('sengsoon','pass2',1,'Phang Seng Soon')");
            mysqli_query($conn, "INSERT INTO Users(userID, password, userLevel , username) VALUES ('koksiong','pass3',1,'Yong Kok Siong')");

            //Close connection
            mysqli_close($conn);
        ?>
        <br><br> <b>Insertion was successful</b> <br><br>
    </body>
</html>



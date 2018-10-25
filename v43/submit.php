<?php
    if(isset($_POST["username"]) && 
        isset($_POST["mail"]) && 
        isset($_POST["password"])) 
    {
        $dbc_uppgift = mysqli_connect("localhost", "root", "", "uppgift");
    
        $username = $_POST["username"];
        $mail = $_POST["mail"];
        $password = $_POST["password"];

        $query = "INSERT INTO users(username, mail, password) VALUES ('$username', '$mail', '$password')";

        mysqli_query($dbc_uppgift, $query);
        
        $error = mysqli_errno($dbc_uppgift);
        //NOTE: 1062 error code is Duplicate entry for unique columns
        if ($error == 1062) {
            echo "<h1>Error</h1>";
            echo "<h3>Username or Mail is already in use</h3>";
        }
        else {
            echo "<h1>$username is now registered</h1>";
        }
    }
    else {
        header("location: index.php");
    }
?>
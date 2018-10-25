<?php
    $dbc_uppgift = mysqli_connect("localhost", "root", "", "uppgift");

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($dbc_uppgift, $query);
    
    if(mysqli_num_rows($result) == 1) {
        while($row = mysqli_fetch_array($result)) {
            echo "ID: " . $row["user_id"] . "<br>";
            echo "Username: " . $row["username"] . "<br>";
            echo "Password: " . $row["password"] . "<br>";
        }
    } else {
        echo "<h1>Error</h1>";
    }
?>
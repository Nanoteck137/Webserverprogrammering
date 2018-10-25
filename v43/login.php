<?php
    session_start();

    $dbc_uppgift = mysqli_connect("localhost", "root", "", "uppgift");

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($dbc_uppgift, $query);
    
    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $_SESSION["login_valid"] = true;
        $_SESSION["name"] = $row["username"];
    } else {
        echo "<h1>Invalid Username or Password</h1>";
        $_SESSION["login_valid"] = false;
    }

    header("location: index.php");
?>
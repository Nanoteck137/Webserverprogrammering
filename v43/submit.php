<?php
    $dbc_uppgift = mysqli_connect("localhost", "root", "", "uppgift");

    $username = $_POST["username"];
    $mail = $_POST["mail"];
    $password = $_POST["password"];


    $query = "INSERT INTO users(username, mail, password) VALUES ('$username', '$mail', '$password')";
    mysqli_query($dbc_uppgift, $query);
    mysqli_info($dbc_uppgift);
?>
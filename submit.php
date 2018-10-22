<?php
    $dbc = mysqli_connect("localhost", "root", "", "hack");

    $name = $_POST["name"];
    $wow = $_POST["wow"];
    $query = "INSERT INTO test VALUES ('$name', '$wow');";

    mysqli_query($dbc, $query);
    echo mysqli_error($dbc);
?>
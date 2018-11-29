<?php
$dbc_website = mysqli_connect("localhost", "root", "", "website");

//TODO: Check if the connection failed

mysqli_query($dbc_website, "SET NAMES utf8");
?>
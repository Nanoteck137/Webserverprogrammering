<?php
$dbc_website = mysqli_connect("localhost", "root", "", "website");

//TODO: Check if the connection failed

mysqli_set_charset($dbc_website, "utf8");

?>
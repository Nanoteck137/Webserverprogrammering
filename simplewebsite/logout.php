<?php
    session_start();

    require("include/auth.php");

    logout();

    header("location: index.php");
    exit();
?>
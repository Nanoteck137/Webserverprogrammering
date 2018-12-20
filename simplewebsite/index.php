<?php
    session_start();

    require("include/common.php");

    if(is_logged_in()) {
        header("location: posts.php");
        exit();
    }

    header("location: login.php");
    exit();
?>
<?php
    session_start();

    $_SESSION["login_valid"] = false;
    unset($_SESSION["name"]);

    header("location: index.php");
?>
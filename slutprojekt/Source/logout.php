<?php
    session_start();
    require_once("./private/database.php");
    require_once("./private/user.php");
?>

<?php 
    signout();
    
    header("location: index.php");
    exit();
?>
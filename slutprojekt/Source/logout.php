<?php
    require_once("private/common.php");
    common_start();
?>

<?php 
    $auth->Logout();
    
    header("location: index.php");
    exit();
?>
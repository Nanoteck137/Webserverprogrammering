<?php
    require_once("private/common.php");
    common_start();
?>

<?php 
    $auth->Signout();
    
    header("location: index.php");
    exit();
?>
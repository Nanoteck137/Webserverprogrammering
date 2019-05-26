<?php
    require_once("private/common.php");
    common_start();
?>

<?php
    //NOTE(patrik): Sida för att logga ut användaren

    $auth->Logout();
    
    header("location: index.php");
    exit();
?>
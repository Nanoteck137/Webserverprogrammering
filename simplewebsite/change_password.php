<?php

session_start();

require("include/auth.php");
require("include/website_db.php");

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(!is_logged_in()) {
        header("location: index.php");
        exit;
    }

    if(!isset($_POST["old_password"])) {
        $_SESSION["old_password_not_set"] = true;
        header("location: profile.php");
    }

    if(!isset($_POST["new_password"])) {
        $_SESSION["new_password_not_set"] = true;
        header("location: profile.php");
        exit;
    }

    if(!isset($_POST["confirm_password"])) {
        $_SESSION["confirm_password_not_set"] = true;
        header("location: profile.php");
        exit;
    }
    
    $userID = get_user_id();
    $oldPassword = $_POST["old_password"];
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    $query = "SELECT * FROM users WHERE id=$userID";
    $result = mysqli_query($dbc_website, $query);
    
    if(mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_array($result);
        if($row["user_password"] !== $oldPassword) {
            $_SESSION["old_password_not_match"] = true;
            header("location: profile.php");
            exit;
        }

        if($newPassword !== $confirmPassword) {
           $_SESSION["error_confirm_password"] = true;
            header("location: profile.php");
            exit;
        }

        $query = "UPDATE users SET user_password='$newPassword' WHERE id=$userID";
        if(!mysqli_query($dbc_website, $query)) {
            header("location: 500.php");
            exit;
        }
    } else {
        header("location: 500.php");
        exit;
    }
}

?>
<?php

session_start();

require("include/common.php");

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(!is_logged_in()) {
        header("location: index.php");
        exit();
    }

    if(!isset($_POST["old_password"]) && empty($_POST["old_password"])) {
        $_SESSION["error"] = new MyError(ErrorType::CHPWD_OLD_PASSWORD_NOT_SET);
        header("location: profile.php");
        exit();
    }

    if(!isset($_POST["new_password"])) {
        $_SESSION["error"] = new MyError(ErrorType::CHPWD_NEW_PASSWORD_NOT_SET);
        header("location: profile.php");
        exit();
    }

    if(!isset($_POST["confirm_password"])) {
        $_SESSION["error"] = new MyError(ErrorType::CHPWD_CONFIRM_PASSWORD_NOT_SET);
        header("location: profile.php");
        exit();
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
            $_SESSION["error"] = new MyError(ErrorType::CHPWD_PASSWORD_NOT_MATCH);
            header("location: profile.php");
            exit();
        }

        if($newPassword !== $confirmPassword) {
            $_SESSION["error"] = new MyError(ErrorType::CHPWD_NEW_PASSWORD_NOT_MATCH);
            header("location: profile.php");
            exit();
        }

        $query = "UPDATE users SET user_password='$newPassword' WHERE id=$userID";
        if(!mysqli_query($dbc_website, $query)) {
            $_SESSION["error"] = new MyError(ErrorType::MYSQL_QUERY_FAILED);
            header("location: 500.php");
            exit();
        }

        header("location: profile.php");
    } else {
        $_SESSION["error"] = new MyError(ErrorType::UNKNOWN);
        header("location: 500.php");
        exit();
    }
}

?>
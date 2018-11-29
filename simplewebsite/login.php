<?php
session_start();

require("include/website_db.php");

if(isset($_SESSION["valid_login"]) && $_SESSION["valid_login"] === true) {
    header("location: index.php");
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
    //Handle login request
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE user_name='$username'";
    $result = mysqli_query($dbc_website, $query);

    if(mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_array($result);
        //TODO: Hash password
        if($row["user_password"] === $password) {
            //NOTE: Login
            $_SESSION["valid_login"] = true;
            $_SESSION["user_id"] = $row["id"];

            header("location: index.php");
        } else {
            //NOTE: Login Failed
            header("location: login.php");
        }
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <?php 
    require("template/head.php");
    ?>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div id="container">
        <?php
        require("template/header.php");
        ?>

        <form action="login.php" method="post" id="login">
            <input type="text" placeholder="Username" name="username">
            <input type="password" placeholder="Password" name="password">
            <input type="submit" name="submit" value="Login">
        </form>

        <?php
        require("template/footer.php");
        ?>
    </div>
</body>
</html>
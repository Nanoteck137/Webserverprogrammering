<?php
session_start();

require("include/website_db.php");

if (isset($_SESSION["valid_login"]) && $_SESSION["valid_login"] === true) {
    header("location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["registerSubmit"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password = $_POST["confirm_password"];
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <?php 
    require("template/head.php");
    ?>
</head>
<body>
    <div id="container">
        <?php
        require("template/header.php");
        ?>

        <div id="content">
            <form action="register.php" method="post">
                <input type="text" placeholder="Username" name="username">
                <input type="email" placeholder="Email" name="email">
                <input type="password" placeholder="Password" name="password">
                <input type="password" placeholder="Confirm Password" name="confirm_password">
                <input type="submit" name="registerSubmit" value="Register">
            </form>
        </div>

        <?php
        require("template/footer.php")
        ?>
    </div>
</body>
</html>
<?php
session_start();

require("include/website_db.php");

if(isset($_SESSION["valid_login"]) && $_SESSION["valid_login"] === true) {
    header("location: index.php");
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["loginSubmit"])) {
        //Handle login request
        $username = $_POST["username"];
        $password = $_POST["password"];

        $query = "SELECT * FROM users WHERE user_name LIKE '%$username%'";
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
                //NOTE: Login Failed, Password check failed
                $_SESSION["valid_login"] = false;
                header("location: login.php");
            }
        } else {
            //No user exists
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

        <div id="content">
            <form class="form card" action="login.php" method="post">
                <!--<input type="text" placeholder="Username" name="username">
                <input type="password" placeholder="Password" name="password">
                <input type="submit" name="loginSubmit" value="Login">
                <p>Don't have an account, register one <a href="register.php">here</a></p>-->

                <div class="form-input-group card">
                    <input class="form-input" type="text" name="username" required>
                    <label class="form-label">Username</label>
                </div>

                <div class="form-input-group card">
                    <input class="form-input" type="password" name="password" required>
                    <label class="form-label">Password</label>
                </div>

                <input class="btn" type="submit" name="loginSubmit" value="Login">
            </form>
        </div>

        <?php
        require("template/footer.php");
        ?>
    </div>
</body>
</html>
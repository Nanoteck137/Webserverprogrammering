<?php
require("include/common.php");

session_start();

if(is_logged_in()) {
    header("location: index.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["loginSubmit"]) && isset($_POST["username"]) && isset($_POST["password"])) {
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
                login($dbc_website, $row["id"]);

                header("location: index.php");
                exit();
            } else {
                //NOTE: Login Failed, Password check failed
                $_SESSION["valid_login"] = false;
                $_SESSION["login_error"] = new MyError(ErrorType::LOGIN_WRONG_PASSWORD);
                header("location: login.php");
                exit();
            }
        } else {
            header("location: 500.php");
            exit();
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
        require("template/menu_header.php");
        ?>

        <?php
            if(isset($_SESSION["login_error"])) {
                switch($_SESSION["login_error"]->get_type()) {
                    case ErrorType::LOGIN_WRONG_PASSWORD: 
                        $wrongPassword = true;
                        break;

                    default: {
                        header("location: 500.php");
                        exit();
                    }
                }

                unset($_SESSION["login_error"]);
            }
        ?>

        <div id="content">
            <form class="form card" action="login.php" method="post">
                <div class="form-input-group card">
                    <input class="form-input" type="text" name="username" required>
                    <label class="form-label">Username</label>
                </div>

                <div class="<?=$wrongPassword ? "form-error" : "" ?> form-input-group card">
                    <input class="form-input" type="password" name="password" required>
                    <label class="form-label">Password</label>
                </div>

                <button class="btn" id="login-button" type="submit" name="loginSubmit">Login</button>

                <p id="login-register-text">Register an account <a href="register.php">here</a></p>
            </form>

        </div>

        <?php
        require("template/footer.php");
        ?>
    </div>
</body>
</html>
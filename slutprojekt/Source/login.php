<?php
require_once("./private/database.php");
require_once("./private/user.php");

?>

<!DOCTYPE html>
<html>

<head>
    <?php include "template/head.php" ?>

    <link rel="stylesheet" href="css/pages/login.css">
</head>

<body>
    <?php
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        try {
            $user = get_user_from_username($database_main, $_POST["username"]);
        } catch(UserNotFoundException $e) {
            echo $e->getMessage();
        }

        //TODO(patrik): Hash the passwords
        if ($user->password === $_POST["password"]) {
            signin($user);
        } else {
            //TODO(patrik): Show the user a error
        }
    }
    ?>

    <div id="container">
        <?php include "template/header.php" ?>

        <main>
            <form action="login.php" method="post">
                <div id="login-space"></div>
                <p id="login-title">Login</p>

                <input class="form-input" type="text" name="username" placeholder="Username">
                <input class="form-input" type="password" name="password" placeholder="Password">

                <p id="login-register-account">Register a account <a href="register.php">here</a></p>

                <div id="login-space"></div>

                <input class="form-input" type="submit" value="Login">
            </form>
        </main>

        <?php include "template/footer.php" ?>
    </div>
</body>

</html>
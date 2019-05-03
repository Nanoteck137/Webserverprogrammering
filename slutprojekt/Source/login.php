<!DOCTYPE html>
<html>

<head>
    <?php include "template/head.php" ?>

    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div id="container">
        <?php include "template/header.php" ?>

        <main>
            <form action="view_profile.php" method="get">
                <p>Login</p>

                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">

                <p id="login-register-account">Register a account <a href="register.php">here</a></p>

                <div id="login-space"></div>

                <input type="submit" value="Login">
            </form>
        </main>

        <?php include "template/footer.php" ?>
    </div>
</body>

</html>
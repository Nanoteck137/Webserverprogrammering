<!DOCTYPE html>
<html>

<head>
    <?php include "template/head.php" ?>

    <link rel="stylesheet" href="css/pages/login.css">
</head>

<body>
    <div id="container">
        <?php include "template/header.php" ?>

        <main>
            <!-- TODO(patrik): Change action to login.php -->
            <form action="view_profile.php" method="get">
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
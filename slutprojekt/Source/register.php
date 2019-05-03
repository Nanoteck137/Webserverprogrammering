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
            <form action="register.php" method="get">
                <div id="login-space"></div>
                <p>Register</p>


                <input type="text" name="name" placeholder="Name">
                <input type="text" name="username" placeholder="Username">
                <input type="text" name="email" placeholder="Email">
                <input type="date" name="birthday">
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
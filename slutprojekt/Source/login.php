<?php
    require_once("private/common.php");
    common_start();
?>

<!DOCTYPE html>
<html>

<head>
    <?php include "template/head.php" ?>

    <link rel="stylesheet" href="css/common/forum.css">
    <link rel="stylesheet" href="css/pages/login.css">
</head>

<body>
    <?php
    $signin_error = false;

    if($auth->IsUserLoggedIn())
    {
        header("location: index.php");
        exit();
    }

    if (isset($_POST["username"]) && isset($_POST["password"])) 
    {
        try 
        {
            $user = $auth->GetUserByUsername($_POST["username"]);
            //$user = get_user_from_username($database_main, );
            //TODO(patrik): Hash the passwords
            if ($user->password === $_POST["password"]) 
            {
                $auth->Login($user);
                
                header("location: index.php");
                exit();
            } 
            else 
            {
                //TODO(patrik): Show the user a error
                $signin_error = true;
            }
        } 
        catch(UserNotFoundException $e) 
        {
            $signin_error = true;
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
                <?php
                if($signin_error === true) 
                {
                ?>
                <p class="error-text">* Incorrect Username or Password</p>
                <?php
                }
                ?>
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
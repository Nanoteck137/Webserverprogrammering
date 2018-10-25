<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Title</title>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        p {
            display: inline-block;
            width: 100px;
            text-align: right;
        }

        form {
            margin: 10px;
        }
    </style>
</head>
<body>
    <?php
        session_start();

        if($_SESSION["login_valid"] == true) {
            echo "<h2>Hello " . $_SESSION["name"] . "</h1>"; 
        }
    ?>
    <form action="submit.php" method="post">
        <p>Username:</p> <input type="text" name="username"> <br>
        <p>Mail:</p> <input type="mail" name="mail"> <br>
        <p>Password:</p> <input type="password" name="password"> <br>
        <input type="submit" value="Register">
    </form>
    <br>
    <form action="login.php" method="post">
        <p>Username:</p> <input type="text" name="username"> <br>
        <p>Password:</p> <input type="text" name="password"> <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
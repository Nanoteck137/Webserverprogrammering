<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Document</title>
</head>
<body>
    <?php
        session_start();

        if($_SESSION["login_valid"] == true) {
            echo "<h1>Hello " . $_SESSION["name"] . "</h1>";
        } else {
            header("location: index.php");
        }
    ?>

    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
</body>
</html>
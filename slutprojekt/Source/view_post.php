<?php
    session_start();
    require_once("private/database.php");
    require_once("private/user.php");
?>

<!DOCTYPE html>
<html>

<head>
    <?php include "template/head.php" ?>
</head>

<body>
    <div id="container">
        <?php include "template/header.php" ?>
        <main>
            <p>Hello World</p>

            <p>Woooh this is a post and woooh</p>
        </main>
        <?php include "template/footer.php" ?>
    </div>
</body>

</html>
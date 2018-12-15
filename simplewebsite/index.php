<?php
session_start();

require("include/common.php");

?>

<!DOCTYPE html>
<html>
<head>
    <?php 
    require("template/head.php");
    ?>
</head>
<body>
    <div id="container">
        <?php
        require("template/header.php");
        ?>

        <div id="content">
            <h1>Hello World</h1>
        </div>

        <?php
        require("template/footer.php")
        ?>
    </div>
</body>
</html>
<?php
session_start();

require("include/website_db.php");
require("include/auth.php");

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
        </div>

        <?php
        require("template/footer.php")
        ?>
    </div>
</body>
</html>
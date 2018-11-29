<?php
session_start();

require("include/website_db.php");

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



        <?php
        require("template/footer.php")
        ?>
    </div>
</body>
</html>
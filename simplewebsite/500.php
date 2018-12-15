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
        require("template/menu_header.php");
        ?>

        <div id="content">
            <h1>500 - Internal Server Error</h1>
        </div>

        <?php
        require("template/footer.php")
        ?>
    </div>
</body>
</html>
<?php
    session_start();
    require("include/auth.php");
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

        <div id="content">
            <?php
            if (is_logged_in()) {
                $profile = get_user_data($dbc_website);
            ?>
                <h3>Username: <?php echo $profile->get_user_name(); ?></h3>
                <h3>Email: <?php echo $profile->get_email(); ?></h3>
                <h3>Type: <?php echo $profile->get_type(); ?></h3>
            <?php
            }
            ?>
        </div>

        <?php
        require("template/footer.php")
        ?>
    </div>
</body>
</html>
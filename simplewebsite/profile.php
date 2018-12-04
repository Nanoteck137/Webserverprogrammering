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

    <link rel="stylesheet" href="css/profile.css">
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
                <div id="info" class="card">
                    <h3>Username: <?=$profile->get_user_name();?></h3>
                    <h3>Email: <?=$profile->get_email();?></h3>
                    <h3>Type: <?=$profile->get_type();?></h3>
                    <h3>Settings: <?=$profile->get_settings();?></h3>
                </div>
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
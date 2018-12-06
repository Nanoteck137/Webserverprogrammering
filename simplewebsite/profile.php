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
                    <img src="image/default_profile.jpg" alt="Profile Picture">
                    <div id="info-right">
                        <h3>Username: <?=$profile->get_user_name();?></h3>
                        <h3>Email: <?=$profile->get_email();?></h3>
                        <h3>Type: <?=$profile->get_type();?></h3>
                    </div>

                    <button class="btn" id="logout">Logout</button>
                </div>
            <?php
            }
            ?>
        </div>

        <?php
        require("template/footer.php")
        ?>

        <script>
        
        document.getElementById("logout").addEventListener("click", () => {
            window.location.href = "logout.php";
        });

        </script>
    </div>
</body>
</html>
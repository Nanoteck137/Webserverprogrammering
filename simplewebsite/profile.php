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
                $profile = get_user_data($dbc_website, get_user_id());
            ?>
                <div id="errors">
                    <?php
                    if(isset($_SESSION["error"])) {
                        //TODO: Handle error
                        var_dump($_SESSION["error"]);
                    }
                    ?>
                </div>
                <div id="info" class="card">
                    <img src="image/default_profile.jpg" alt="Profile Picture">
                    <div id="info-right">
                        <h3>Username: <?=$profile->get_user_name();?></h3>
                        <h3>Email: <?=$profile->get_email();?></h3>
                        <h3>Type: <?=$profile->get_type();?></h3>
                    </div>

                    <div id="change-password">
                        <form action="change_password.php" method="post">
                            <div class="form-input-group card">
                                <input class="form-input" type="password" name="old_password" autocomplete="off" required>
                                <label class="form-label">Old Password</label>
                            </div>

                            <div class="form-input-group card">
                                <input class="form-input" type="password" name="new_password" autocomplete="off" required>
                                <label class="form-label">New Password</label>
                            </div>

                            <div class="form-input-group card">
                                <input class="form-input" type="password" name="confirm_password" value="" autocomplete="off" required>
                                <label class="form-label">Confirm Password</label>
                            </div>

                            <button id="change-password-button" class="btn" type="submit">Change Password</button>
                        </form>
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
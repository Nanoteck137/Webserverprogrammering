<?php
    session_start();
    require_once("private/database.php");
    require_once("private/user.php");
?>

<!DOCTYPE html>
<html>

<head>
    <?php include "template/head.php" ?>

    <link rel="stylesheet" href="css/pages/settings.css">
</head>

<body>
    <?php
        redirect_not_user_signedin("login.php");
    ?>

    <div id="container">
        <?php include "template/header.php" ?>

        <main>
            <p id="settings-title">Settings</p>

            <!--<form id="settings-change-password" action="settings.php" method="get">
                <div class="form-group">
                    <p class="form-group-title">Old Password</p>
                    <input class="form-input" type="password" name="old_password">
                </div>

                <div class="form-group">
                    <p class="form-group-title">New Password</p>
                    <input class="form-input" type="password" name="new_password">
                </div>

                <div class="form-group">
                    <p class="form-group-title">Confirm Password</p>
                    <input class="form-input" type="password" name="confirm_new_password">
                </div>
            </form>-->

            <div id="settings-items">
                <div class="settings-item">
                    <p>Change password</p>
                    <button class="settings-item-button">Change</button>

                    <div class="settings-item-open">
                        <form action="settings.php" action="get">
                            <input class="form-input" type="password" name="old_password" placeholder="Old Password">
                            <input class="form-input" type="password" name="new_password" placeholder="New Password">
                            <input class="form-input" type="password" name="confirm_new_password"
                                placeholder="Confirm New Password">
                            <input class="form-input" type="submit" value="Change password">
                        </form>
                    </div>
                </div>

                <div class="settings-item">
                    <p>Change email</p>
                    <button class="settings-item-button">Change</button>

                    <div class="settings-item-open">
                        <form action="settings.php" method="get">
                            <input class="form-input" type="text" name="old_email" placeholder="Old Email">
                            <input class="form-input" type="text" name="new_email" placeholder="New Email">
                            <input class="form-input" type="submit" value="Change Email">
                        </form>
                    </div>
                </div>

                <div class="settings-item">
                    <p>Change theme</p>
                    <button class="settings-item-button">Change</button>

                    <div class="settings-item-open">
                        <form action="settings.php" method="get">
                            <label class="settings-theme-item">
                                <input type="radio" name="theme" value="light">
                                <p>Light Theme</p>
                            </label>

                            <label class="settings-theme-item">
                                <input type="radio" name="theme" value="dark">
                                <p>Dark Theme</p>
                            </label>

                            <input class="form-input" type="submit" value="Change Theme">
                        </form>
                    </div>
                </div>
            </div>

            <div id="modal">
                <div id="modal-content">
                </div>
            </div>
        </main>

        <?php include "template/footer.php" ?>

        <script src="js/settings.js"></script>
    </div>
</body>

</html>
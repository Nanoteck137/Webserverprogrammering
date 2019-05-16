<?php
    require_once("private/common.php");
    common_start();
?>

<?php

$change_password_confirm_error = false;
$change_passsword_old_password_match_error = false;

function is_change_password() 
{
    return isset($_POST["old_password"]) && isset($_POST["new_password"]) && isset($_POST["confirm_new_password"]);
}

if(is_change_password())
{
    if($_POST["new_password"] !== $_POST["confirm_new_password"]) 
    {
        $change_password_confirm_error = true;
    } 
    else 
    {
        $user = $auth->GetLoggedInUser();
        $oldPassword = $_POST["old_password"];
        $newPassword = $_POST["new_password"];
        if($user->ChangePassword($oldPassword, $newPassword)) 
        {
            header("location: settings.php");
            exit();
        } 
        else 
        {
            $change_passsword_old_password_match_error = true;
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <?php include "template/head.php" ?>

    <link rel="stylesheet" href="css/pages/settings.css">
</head>

<body>
    <?php
        $auth->RedirectNotLoggedIn();
    ?>

    <div id="container">
        <?php include "template/header.php" ?>

        <main>
            <p id="settings-title">Settings</p>

        <?php
        if($change_password_confirm_error === true)
        {
        ?>
            <p class="error-text">Change Password: New passwords diden't match</p>
        <?php
        }
        ?>

        <?php
        if ($change_passsword_old_password_match_error === true) 
        {
        ?>
            <p class="error-text">Change Password: Old password diden't match</p>
        <?php
        }
        ?>

            <div id="settings-items">
                <div class="settings-item">
                    <p>Change password</p>
                    <button class="settings-item-button">Change</button>

                    <div class="settings-item-open">
                        <form action="settings.php" method="post">
                            <input class="form-input" type="password" name="old_password" placeholder="Old Password" required>
                            <input class="form-input" type="password" name="new_password" placeholder="New Password" required>
                            <input class="form-input" type="password" name="confirm_new_password" placeholder="Confirm New Password" required>
                            <input class="form-input" type="submit" value="Change password">
                        </form>
                    </div>
                </div>

                <div class="settings-item">
                    <p>Change email</p>
                    <button class="settings-item-button">Change</button>

                    <div class="settings-item-open">
                        <form action="settings.php" method="post">
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
                        <form action="settings.php" method="post">
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
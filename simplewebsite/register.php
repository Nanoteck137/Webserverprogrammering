<?php
session_start();

require("include/common.php");

if (isset($_SESSION["valid_login"]) && $_SESSION["valid_login"] === true) {
    header("location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["registerSubmit"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm_password"];
        $wasAnError = false;

        //Password confirm check
        if($password !== $confirmPassword) {
            $passwordMatchFailed = true;
            $wasAnError = true;
        } else {
            $passwordMatchFailed = false;
        }

        //Username check
        $query = "SELECT * FROM users WHERE user_name LIKE '%$username%'";
        $result = mysqli_query($dbc_website, $query);
        if(mysqli_num_rows($result) !== 0) {
            //Username already exists
            $usernameExists = true;
            $wasAnError = true;
        } else {
            $usernameExists = false;
        }

        //Email check
        $query = "SELECT * FROM users WHERE user_email LIKE '%$email%'";
        $result = mysqli_query($dbc_website, $query);
        if (mysqli_num_rows($result) !== 0) {
            //Email already registerd exists
            $emailExists = true;
            $wasAnError = true;
        } else {
            $emailExists = false;
        }

        //Register the user if the password matched, the username is free and if the email is not in use 
        if(!$passwordMatchFailed && !$usernameExists && !$emailExists) {
            //Insert into database
            $query = "INSERT INTO users(user_name, user_email, user_password) VALUES ('$username', '$email', '$password')";
            if(!mysqli_query($dbc_website, $query)) {
                header("location: 500.php");
                exit();
            } else {
                $query = "SELECT * FROM users WHERE user_name = '$username'";
                $result = mysqli_query($dbc_website, $query);
                if (mysqli_num_rows($result) === 1) {
                    $row = mysqli_fetch_array($result);
                    $_SESSION["valid_login"] = true;
                    $_SESSION["user_id"] = $row["id"];

                    header("location: profile.php");
                    exit();
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <?php 
    require("template/head.php");
    ?>

    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <div id="container">
        <?php
        require("template/header.php");
        ?>

        <div id="content">
            <?php

            ?>

            <?php
            if(isset($wasAnError) && $wasAnError) {
            ?>
                <div class="card" id="error-messages">
                    <?php
                    if (isset($usernameExists) && $usernameExists) {
                        echo "<p>Username exists</p>";
                    }

                    if (isset($emailExists) && $emailExists) {
                        echo "<p>Email in use</p>";
                    }

                    if (isset($passwordMatchFailed) && $passwordMatchFailed) {
                        echo "<p>Password does not match</p>";
                    }
                    ?>
                </div>
            <?php
            }
            ?>

            <form class="form card" action="register.php" method="post">
                <div class="form-input-group <?= (isset($usernameExists) && $usernameExists) ? "form-error" : "" ?> card">
                    <input class="form-input" type="text" name="username" autocomplete="off" required>
                    <label class="form-label">Username</label>
                </div>

                <div class="form-input-group <?= (isset($emailExists) && $emailExists) ? "form-error" : "" ?> card">
                    <input class="form-input" type="text" name="email" required>
                    <label class="form-label">Email</label>
                </div>

                <div class="form-input-group card">
                    <input class="form-input" type="password" name="password" autocomplete="off" required>
                    <label class="form-label">Password</label>
                </div>

                <div class="form-input-group <?= (isset($passwordMatchFailed) && $passwordMatchFailed) ? "form-error" : "" ?> card">
                    <input class="form-input" type="password" name="confirm_password" autocomplete="off" required>
                    <label class="form-label">Confirm Password</label>
                </div>

                <button class="btn" id="register-button" type="submit" name="registerSubmit">Register</button>
            </form>
        </div>

        <?php
        require("template/footer.php")
        ?>
    </div>
</body>
</html>
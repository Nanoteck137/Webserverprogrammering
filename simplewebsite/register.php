<?php
session_start();

require("include/website_db.php");

if (isset($_SESSION["valid_login"]) && $_SESSION["valid_login"] === true) {
    header("location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["registerSubmit"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        if($password !== $confirm_password) {
            $password_match = false;
        } else {
            //Username check
            $query = "SELECT * FROM users WHERE user_name LIKE '%$username%'";
            $result = mysqli_query($dbc_website, $query);
            if(mysqli_num_rows($result) !== 0) {
                //Username already exists
                $usernameExists = true;
            }
            //Email check
            $query = "SELECT * FROM users WHERE user_email LIKE '%$email%'";
            $result = mysqli_query($dbc_website, $query);
            if (mysqli_num_rows($result) !== 0) {
                //Email already registerd exists
                $emailExists = true;
            }

            //Insert into database
            $query = "INSERT INTO users(user_name, user_email, user_password) VALUES ('$username', '$email', '$password')";
            if(!mysqli_query($dbc_website, $query)) {
                //Some kind of error
            } else {
                $query = "SELECT * FROM users WHERE user_name = '$username'";
                $result = mysqli_query($dbc_website, $query);
                if (mysqli_num_rows($result) === 1) {
                    $row = mysqli_fetch_array($result);
                    $_SESSION["valid_login"] = true;
                    $_SESSION["user_id"] = $row["id"];

                    header("location: profile.php");
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
</head>
<body>
    <div id="container">
        <?php
        require("template/header.php");
        ?>

        <div id="content">
            <?php
            if(isset($usernameExists) && $usernameExists) {
                echo "<p>Username exists</p>";
            }

            if(isset($emailExists) && $emailExists) {
                echo "<p>Email in use</p>";
            }

            if(isset($password_match) && !$password_match) {
                echo "<p>Password does not match</p>";
            }
            ?>
            <form class="form" action="register.php" method="post">
                <input type="text" placeholder="Username" name="username" autocomplete="off">
                <input type="email" placeholder="Email" name="email">
                <input type="password" placeholder="Password" name="password">
                <input class="<?php echo (isset($password_match) && !$password_match) ?  "form-input-error" : "";?>" type="password" placeholder="Confirm Password" name="confirm_password">
                <input type="submit" name="registerSubmit" value="Register">
            </form>
        </div>

        <?php
        require("template/footer.php")
        ?>
    </div>
</body>
</html>
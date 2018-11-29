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

        <div id="content">
            <?php
            if (isset($_SESSION["valid_login"]) && $_SESSION["valid_login"] === true) {
                $user_id = $_SESSION["user_id"];

                $query = "SELECT * FROM users WHERE id=$user_id";
                $result = mysqli_query($dbc_website, $query);

                if (mysqli_num_rows($result) === 1) {
                    $row = mysqli_fetch_array($result);
            ?>
                    <h3>Username: <?php echo $row["user_name"]; ?></h3>
                    <h3>Email: <?php echo $row["user_email"]; ?></h3>
                    <h3>Password: <?php echo $row["user_password"]; ?></h3>
            <?php
                }
            }
            ?>
        </div>

        <?php
        require("template/footer.php")
        ?>
    </div>
</body>
</html>
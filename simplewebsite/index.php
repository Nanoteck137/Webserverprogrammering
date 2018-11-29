<?php
session_start();

require("include/website_db.php");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Simple Website</title>

    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div id="container">
        <?php
        require("template/header.php");
        ?>

        <?php
        if(isset($_SESSION["valid_login"]) && $_SESSION["valid_login"] === true) {
            $user_id = $_SESSION["user_id"];

            $query = "SELECT * FROM users WHERE id=$user_id";
            $result = mysqli_query($dbc_website, $query);

            if(mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_array($result);
            ?>
                <h1>Username: <?php echo $row["user_name"]; ?></h1>
                <h1>Email: <?php echo $row["user_email"]; ?></h1>
                <h1>Password: <?php echo $row["user_password"]; ?></h1>
        <?php
            }
        }
        ?>

        <?php
        require("template/footer.php")
        ?>
    </div>
</body>
</html>
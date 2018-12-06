<?php
session_start();

require("include/website_db.php");
require("include/common.php");

?>

<!DOCTYPE html>
<html>
<head>
    <?php 
    require("template/head.php");
    ?>

    <link rel="stylesheet" href="css/posts.css">
</head>
<body>
    <div id="container">
        <?php
        require("template/header.php");
        ?>

        <div id="content">
            <?php
            if(isset($_GET["view"])) {
                $id = $_GET["view"];
                $query = "SELECT posts.id, posts.post_name, posts.post_content, posts.post_date, users.user_name FROM posts JOIN users ON posts.post_user_id=users.id WHERE posts.id=$id;";
                $result = mysqli_query($dbc_website, $query);
                $row = mysqli_fetch_array($result);

                $d = new DateTime();
            ?>
                <div id="view-post" class="card">
                    <p id="view-post-name"><?= $row["post_name"]?></p>
                    <p id="view-post-user">By <?= $row["user_name"]?> - <?=get_time(strtotime($row["post_date"])); ?> ago</p>
                    <hr>
                    <p id="view-post-content"><?= $row["post_content"];?></p>
                </div>
            <?php
            } else {
            ?>
                <div id="posts">
                    <?php
                    $query = "SELECT posts.id, posts.post_name, posts.post_date, users.user_name FROM posts JOIN users ON posts.post_user_id=users.id;";
                    $result = mysqli_query($dbc_website, $query);

                    while($row = mysqli_fetch_array($result)) {
                        $d = new DateTime($row["post_date"]);
                    ?>
                        <a class="post card-hover" href="<?= $_SERVER["PHP_SELF"] . "?view=".$row["id"]; ?>">
                            <img id="post-img" src="image/test<?= rand(1, 2); ?>.jpg" alt="post-img">
                            <p id="post-name"><?= $row["post_name"];?></p>
                            <p id="post-author">By <span id="post-author-name"><?= $row["user_name"] ?></span> - <?= get_time(strtotime($row["post_date"]));?> ago</p>
                        </a>
                    <?php
                    }
                    ?>
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
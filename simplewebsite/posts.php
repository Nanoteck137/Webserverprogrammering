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

                $d = new DateTime($row["post_date"]);
            ?>
                <div id="view-post" class="card">
                    <p id="view-post-name"><?php echo $row["post_name"]?></p>
                    <p id="view-post-user">By <?php echo $row["user_name"]?> - <?php echo $d->format("Y-m-d");?></p>
                    <p id="view-post-content"><?php echo $row["post_content"];?></p>
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
                        <a class="post card-hover" href="<?php echo $_SERVER["PHP_SELF"] . "?view=".$row["id"]; ?>">
                            <img id="post-img" src="image/test.jpg" alt="post-img">
                            <p id="post-name"><?php echo $row["post_name"];?></p>
                            <p id="post-author">By <span id="post-author-name"><?php echo $row["user_name"] ?></span> - <?php echo $d->format("Y-m-d");?></p>
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
<?php
session_start();

require("include/common.php");

if(!is_logged_in()) {
    header("location: login.php");
    exit(); 
}

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
        require("template/menu_header.php");
        ?>

        <div id="content">
            <?php
            if(isset($_GET["q"])) {
            ?>
                <div class="card" id="post-search-result">
                    <p>Search Results For: <span><?= $_GET["q"]; ?></span></p>
                </div>
            <?php
            }
            ?>
            <div class="card" id="post-header">
                <form action="posts.php" method="get">
                    <div id="post-search-bar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="darkgray" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
                        <input type="search" name="q" placeholder="Search" value="<?= isset($_GET["q"]) ? $_GET["q"] : "" ?>">
                    </div>

                    <select name="sort" id="post-search-sort">
                        <option value="newest" <?= (isset($_GET["sort"]) && $_GET["sort"] === "newest") ? "selected" : "" ?>>Newest</option>
                        <option value="oldest" <?= (isset($_GET["sort"]) && $_GET["sort"] === "oldest") ? "selected" : "" ?>>Oldest</option>
                        <option value="az" <?= (isset($_GET["sort"]) && $_GET["sort"] === "az") ? "selected" : "" ?>>A-Z</option>
                        <option value="za" <?= (isset($_GET["sort"]) && $_GET["sort"] === "za") ? "selected" : "" ?>>Z-A</option>
                    </select>

                    <button class="btn" type="submit">Search</button>

                    <button class="btn" id="post-new-post-button" type="button" onclick="window.location.href='new_post.php';">New post</button>
                </form>
            </div>
            <?php
            if(isset($_GET["view"])) {
                $id = $_GET["view"];
                $query = "SELECT posts.id, posts.post_name, posts.post_content, posts.post_date, users.user_name FROM posts JOIN users ON posts.post_user_id=users.id WHERE posts.id=$id;";
                $result = mysqli_query($dbc_website, $query);
                $row = mysqli_fetch_array($result);
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
                <div class="card" id="posts">
                    <?php

                    $custom = "";

                    //Search query
                    if(isset($_GET["q"])) {
                        $searchQuery = $_GET["q"];
                        $custom = "WHERE posts.post_name LIKE '%$searchQuery%' ";
                    }

                    if(isset($_GET["sort"])) {
                        $sort = $_GET["sort"];
                        $order = "";
                        if($sort === "newest") {
                            $order .= "ORDER BY posts.post_date DESC ";
                        } else if($sort === "oldest") {
                            $order .= "ORDER BY posts.post_date ASC ";
                        } else if($sort === "az") {
                            $order .= "ORDER BY posts.post_name DESC ";
                        } else if ($sort === "az") {
                            $order .= "ORDER BY posts.post_name ASC ";
                        } else {
                            $order = "";
                        }

                        $custom .= $order;
                    } else {
                        $custom .= "ORDER BY posts.post_date DESC ";
                    }

                    $query = "SELECT posts.id, posts.post_name, posts.post_date, users.user_name FROM posts JOIN users ON posts.post_user_id=users.id $custom;";
                    $result = mysqli_query($dbc_website, $query);

                    while($row = mysqli_fetch_array($result)) {
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
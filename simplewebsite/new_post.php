<?php
session_start();

require("include/common.php");

if(!is_logged_in()) {
    header("location: login.php");
    exit();
}

//TODO: Check the string sizes

if(!isset($_POST["post_name"])) {
    $post_name_exists = false;
} else {
    $post_name_exists = true;
}

if(!isset($_POST["post_content"])) {
    $post_content_exists = false;
} else {
    $post_content_exists = true;
}

if($post_name_exists && $post_content_exists) {
    $post_name = mysqli_real_escape_string($dbc_website, $_POST["post_name"]);
    $post_content = str_replace("'", "\"", $_POST["post_content"]);
    $user_id = get_user_id();

    $query = "INSERT INTO posts(post_name, post_content, post_user_id) VALUES ('$post_name', '$post_content', $user_id)";
    if(!mysqli_query($dbc_website, $query)) {
        header("location: 500.php");
        exit();
    } else {
        header("location: posts.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <?php 
    require("template/head.php");
    ?>

    <link rel="stylesheet" href="css/new_post.css">
</head>
<body>
    <div id="container">
        <?php
        require("template/header.php");
        ?>

        <div class="card" id="content">
            <form id="post-form" action="" method="post">
                <div id="post-name" class="form-input-group card">
                    <input class="form-input" type="text" name="post_name" autocomplete="off" required>
                    <label class="form-label">Post name</label>
                </div>

                <div id="post-content" class="form-input-group card">
                    <textarea class="form-input" name="post_content" cols="30" rows="10" required></textarea>
                    <label class="form-label">Content</label>
                </div>

                <button class="btn" type="submit">Post</button>
            </form>
        </div>

        <?php
        require("template/footer.php")
        ?>
    </div>
</body>
</html>
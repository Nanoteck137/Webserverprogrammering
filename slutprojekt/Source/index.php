<?php
    require_once("private/common.php");
    common_start();
?>

<?php

function printPost($post)
{
?>
    <div class="forum-post">
        <div class="forum-author">
            <a
                href="view_profile.php?p=<?php echo $post->author->id; ?>"><?php echo $post->author->username ?></a>
            <p><?php echo format_time_data($post->createdDate); ?> ago</p>
        </div>

        <a class="forum-title" href="view_post.php?p=<?php echo $post->id;?>">
            <p><?php echo $post->title; ?></p>
        </a>
    </div>
<?php
}

?>

<!DOCTYPE html>
<html>

<head>
    <?php include "template/head.php" ?>

    <link rel="stylesheet" href="css/pages/home.css">
    <link rel="stylesheet" href="css/common/forum.css">
</head>

<body>
    <div id="container">
        <?php include "template/header.php" ?>
        <main>
            <p style="text-align: center; margin: 20px 0px; font-size: 1.2em;">Welcome to <span style="font-weight: bold;">Stackunderflow</span></p>

            <?php
            $posts = $forum->GetAllPopularPosts();
            ?>

            <p style="text-align: center; margin: 10px 0px; font-size: 1.1em;">Here is some popular posts</p>
            <div id="all-forum-posts">
            <?php

            for($i = 0; $i < count($posts); $i++)
            {
                printPost($posts[$i]);
            }

            ?>
        </div>

        </main>
        <?php include "template/footer.php" ?>
    </div>
</body>

</html>
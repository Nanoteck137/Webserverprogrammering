<?php
    session_start();
    require_once("private/database.php");
    require_once("private/user.php");
    require_once("private/forum.php");

    require_once("private/common.php");
?>

<!DOCTYPE html>
<html>

<head>
    <?php include "template/head.php" ?>
    <link rel="stylesheet" href="css/pages/view_post.css">
</head>

<body>
    <?php
        if(!isset($_GET["p"])) 
        {
            header("location: index.php");
            exit();
        }

        if(isset($_POST["create_comment_content"])) 
        {
            $last_post_id = $_GET["p"];
            $content = $_POST["create_comment_content"];
            my_log("Created comment: $content");
            header("location: view_post.php?p=$last_post_id");
            exit();
        }

        try 
        {
            $post = get_post_by_id($database_main, $_GET["p"]);
        } 
        catch(Exception $e) 
        {
            header("location: index.php");
            exit();
        }
    ?>
    <div id="container">
        <?php include "template/header.php" ?>
        <main>
            <div id="view-post-author">
                <a href="view_profile.php"><?php echo $post->author->username; ?></a>
                <p>2 hour ago</p>
            </div>

            <p id="view-post-title"><?php echo $post->title; ?></p>

            <p id="view-post-content"><?php echo $post->content; ?></p>

            <div id="view-post-info">
                <a><i class="fas fa-chevron-up"></i> 4 <span class="view-post-info-text">upvotes</span></a>
                <p><i class="fas fa-comments"></i> 22 <span class="view-post-info-text">Comments</span></p>
                <p><i class="fas fa-chevron-down"></i> 2 <span class="view-post-info-text">downvotes</span></p>
            </div>

            <div id="view-post-comments">

                <?php
            for($i = 0; $i < 22; $i++) 
            {
            ?>
                <div class="view-post-comment">
                    <div class="view-post-comment-author">
                        <a href="view_profile.php">Nanoteck137</a>
                        <p>1 hour ago</p>
                    </div>

                    <p class="view-post-commment-content">Test comment</p>
                </div>
                <?php
            }
            ?>

            </div>

            <div id="view-post-create-comment">
                <form action="view_post.php?p=<?php echo $post->id; ?>" method="post">
                    <textarea class="form-input" name="create_comment_content" cols="30" rows="5"
                        placeholder="Create Comment"></textarea>
                    <input class="form-input" type="submit" value="Post Comment">
                </form>
            </div>
        </main>
        <?php include "template/footer.php" ?>
    </div>
</body>

</html>
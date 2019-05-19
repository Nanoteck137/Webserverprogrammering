<?php
    require_once("private/common.php");
    common_start();
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
            $post = $forum->GetPostById($_GET["p"]);
            $user = $auth->GetLoggedInUser();
            $content = $_POST["create_comment_content"];

            $post->PostComment($user, $content);
            
            $postID = $post->id;
            header("location: view_post.php?p=$postID");
            exit();
        }

        try 
        {
            $post = $forum->GetPostById($_GET["p"]);
            $comments = $post->GetAllComments();
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
                <p><?php echo format_time_data($post->createdDate); ?> ago</p>
            </div>

            <p id="view-post-title"><?php echo $post->title; ?></p>

            <p id="view-post-content"><?php echo $post->content; ?></p>

            <div id="view-post-info">
                <a href="rate.php?r=upvote&p=<?php echo $post->id; ?>"><i class="fas fa-chevron-up"></i> <?php echo $post->GetUpvotesCount(); ?> <span class="view-post-info-text">upvotes</span></a>
                <p><i class="fas fa-comments"></i> <?php echo count($comments); ?> <span class="view-post-info-text">Comments</span></p>
                <a href="rate.php?r=downvote&p=<?php echo $post->id; ?>"><i class="fas fa-chevron-down"></i> <?php echo $post->GetDownvotesCount(); ?> <span class="view-post-info-text">downvotes</span></a>
            </div>

            <div id="view-post-comments">

            <?php
            for($i = 0; $i < count($comments); $i++) 
            {
                $comment = $comments[$i];
            ?>
                <div class="view-post-comment">
                    <div class="view-post-comment-author">
                        <a
                            href="view_profile.php?p=<?php echo $comment->author->id?>"><?php echo $comment->author->username?></a>
                        <p><?php echo format_time_data($comment->createdDate); ?> ago</p>
                    </div>

                    <p class="view-post-commment-content"><?php echo $comment->content; ?></p>
                </div>
            <?php
            }
            ?>

            </div>

            <?php
            if($auth->IsUserLoggedIn()) 
            {
            ?>
            <div id="view-post-create-comment">
                <form action="view_post.php?p=<?php echo $post->id; ?>" method="post">
                    <textarea class="form-input" name="create_comment_content" cols="30" rows="5"
                        placeholder="Create Comment"></textarea>
                    <input class="form-input" type="submit" value="Post Comment">
                </form>
            </div>
            <?php
            }
            ?>
        </main>
        <?php include "template/footer.php" ?>
    </div>
</body>

</html>
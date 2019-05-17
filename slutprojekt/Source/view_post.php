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
            $last_post_id = $_GET["p"];
            $content = $_POST["create_comment_content"];
            
            $user_id = $auth->GetLoggedInUserId(); //get_current_user_id();
            
            $query = "INSERT INTO forum_comments(forum_id, author, content) VALUES ($last_post_id, $user_id, '$content')";
            $database_main->query($query);
            
            header("location: view_post.php?p=$last_post_id");
            exit();
        }

        try 
        {
            $post = $forum->GetPostById($_GET["p"]); //get_posts_by_id($database_main, $_GET["p"]);
            $comments = array(); //get_comments_from_post($database_main, $post);
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
                <a><i class="fas fa-chevron-up"></i> 4 <span class="view-post-info-text">upvotes</span></a>
                <p><i class="fas fa-comments"></i> <?php echo count($comments); ?> <span
                        class="view-post-info-text">Comments</span></p>
                <p><i class="fas fa-chevron-down"></i> 2 <span class="view-post-info-text">downvotes</span></p>
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
                        <p><?php echo format_time_data($comment->created_date); ?> ago</p>
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
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
        // NOTE(patrik): Om p inte existerar i get variablerna så gå till index.php instället
        if(!isset($_GET["p"]))
        {
            header("location: index.php");
            exit();
        }

        // NOTE(patrik): Om använderan har gjort en kommentar så skapa en column i databasen
        if(isset($_POST["create_comment_content"])) 
        {
            $post = $forum->GetPostById($_GET["p"]);
            $content = $_POST["create_comment_content"];
            $user = $auth->GetLoggedInUser();

            if(!empty($content))
            {
                $post->PostComment($user, $content);
            }
            
            $postID = $post->id;
            header("location: view_post.php?p=$postID");
            exit();
        }

        // NOTE(patrik): Försöker hämta info om den här 
        //               specifika inlägget och kommentarerna 
        //               annars gå till index.php
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

            <?php
            // NOTE(patrik): Om användaren är inloggad och hen kollar på sin egen profil 
            //               så visa kontroller för att ta bort eller redigera sitt inlägg 
            if($auth->IsUserLoggedIn() && $auth->GetLoggedInUser()->id == $post->author->id) 
            {
            ?>
            <div class="view-post-comment-options">
                <a href="#">Edit</a>
                <a href="#">Delete</a>
            </div>
            <?php
            }
            ?>

            <p id="view-post-title"><?php echo $post->title; ?></p>

            <p id="view-post-content"><?php echo $post->content; ?></p>

            <div id="view-post-info">
                <?php
                // NOTE(patrik): Om användaren är inloggad så ska hen 
                //               få kunna göra en upvote eller en downvote
                if($auth->IsUserLoggedIn())
                {
                ?>
                <a href="rate.php?r=upvote&p=<?php echo $post->id; ?>">
                    <i class="fas fa-chevron-up"></i>
                    <?php echo $post->GetUpvotesCount(); ?> <span class="view-post-info-text">upvotes</span>
                </a>
                <?php
                }
                else 
                {
                ?>
                <p href="rate.php?r=upvote&p=<?php echo $post->id; ?>">
                    <i class="fas fa-chevron-up"></i>
                    <?php echo $post->GetUpvotesCount(); ?> <span class="view-post-info-text">upvotes</span>
                </p>
                <?php
                }
                ?>
                
                <p>
                    <i class="fas fa-comments"></i> <?php echo count($comments); ?> <span
                        class="view-post-info-text">Comments</span>
                </p>

                <?php
                if($auth->IsUserLoggedIn())
                {
                ?>
                <a href="rate.php?r=downvote&p=<?php echo $post->id; ?>">
                    <i class="fas fa-chevron-down"></i>
                    <?php echo $post->GetDownvotesCount(); ?> <span class="view-post-info-text">downvotes</span>
                </a>
                <?php
                }
                else
                {
                ?>
                <p href="rate.php?r=downvote&p=<?php echo $post->id; ?>">
                    <i class="fas fa-chevron-down"></i>
                    <?php echo $post->GetDownvotesCount(); ?> <span class="view-post-info-text">downvotes</span>
                </p>
                <?php
                }
                ?>
            </div>

            <div id="view-post-comments">
            <?php
            //NOTE(patrik): Rendera alla kommentarer på detta inlägget
            for($i = 0; $i < count($comments); $i++) 
            {
                $comment = $comments[$i];
            ?>
                <div class="view-post-comment">
                    <div class="view-post-comment-author">
                        <a
                            href="view_profile.php?p=<?php echo $comment->author->id?>"><?php echo $comment->author->username; ?></a>
                        <p><?php echo format_time_data($comment->createdDate); ?> ago</p>
                    </div>

                    <p class="view-post-commment-content"><?php echo $comment->content; ?></p>

                    <?php
                    if($auth->IsUserLoggedIn() && $auth->GetLoggedInUser()->id == $comment->author->id) 
                    {
                    ?>
                    <div class="view-post-comment-options">
                        <a href="#">Edit</a>
                        <a href="#">Delete</a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>

            </div>

            <?php
            // NOTE(patrik): Om användaren är inloggad så ska hen kunna göra en
            //               kommentar och posta det till detta inlägget
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
<?php
    session_start();
    require_once("private/database.php");
    require_once("private/user.php");
?>

<!DOCTYPE html>
<html>

<head>
    <?php include "template/head.php" ?>
    <link rel="stylesheet" href="css/pages/view_post.css">
</head>

<body>
    <div id="container">
        <?php include "template/header.php" ?>
        <main>
            <div id="view-post-author">
                <a href="view_profile.php">Nanoteck137</a>
                <p>2 hour ago</p>
            </div>
            <p id="view-post-title">Hello World</p>

            <p id="view-post-content">Woooh this is a post and woooh</p>
            <div id="view-post-info">
                <p><i class="fas fa-chevron-up"></i> 4 <span class="view-post-info-text">upvotes</span></p>
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

                    <p class="view-post-commment-content">This sucks kill yourself</p>
                </div>
                <?php
            }
            ?>

            </div>
        </main>
        <?php include "template/footer.php" ?>
    </div>
</body>

</html>
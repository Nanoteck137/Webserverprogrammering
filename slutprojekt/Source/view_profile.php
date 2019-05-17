<?php
    require_once("private/common.php");
    common_start();
?>

<!DOCTYPE html>
<html>

<head>
    <?php include "template/head.php" ?>
    <link rel="stylesheet" href="css/pages/view_profile.css">
    <link rel="stylesheet" href="css/common/forum.css">
</head>

<body>
    <?php
        $auth->RedirectNotLoggedIn();

        //$comments = get_comments_from_user_id($database_main, $user);

        $user = $auth->GetLoggedInUser();

        $posts = $forum->GetAllPosts();
        $comments = $forum->GetCommentsFromUser($user);

    ?>

    <div id="container">
        <?php include "template/header.php" ?>

        <main>
            <div id="profile-info">
                <img id="profile-pic" src="img/profile_pic.jpg" alt="Profile Pic" width="250">
                <p id="profile-info-name"><?php echo $user->username?></p>
                <p id="profile-info-posts"><?php echo count($posts); ?> post(s)</p>
                <!-- TODO(patrik): Count the comments s-->
                <p id="profile-info-comments"><?php echo count($comments); ?> comment(s)</p>
            </div>

            <div id="profile">
                <div id="posts-sort" class="forum-sort">
                    <p class="forum-sort-title">Sort</p>
                    <p class="forum-sort-selected">New</p>
                    <ul class="forum-sort-options">
                        <li>Newest</li>
                        <li>Oldest</li>
                    </ul>
                </div>

                <div id="profile-posts">

                    <?php
                    for ($i = 0; $i < count($posts); $i++) 
                    {
                        $post = $posts[$i];
                    ?>
                    <div class="forum-post">
                        <div class="forum-author">
                            <p><?php echo $user->username; ?></p>
                            <p><?php echo format_time_data($post->createdDate); ?> ago</p>
                        </div>

                        <a class="forum-title" href="view_post.php?p=<?php echo $post->id; ?>">
                            <p><?php echo $post->title; ?></p>
                        </a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </main>

        <?php include "template/footer.php" ?>
        <script src="js/view_profile.js"></script>
    </div>
</body>

</html>
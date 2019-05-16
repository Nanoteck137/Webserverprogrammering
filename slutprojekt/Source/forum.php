<?php
    require_once("private/common.php");
    common_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "template/head.php" ?>

    <link rel="stylesheet" href="css/pages/forum.css">
    <link rel="stylesheet" href="css/common/forum.css">
</head>

<body>
    <div id="container">
        <?php include "template/header.php" ?>

        <main>
            <form class="forum-search-bar" action="forum.php" method="get">
                <div id="forum-sort">
                    <p class="forum-sort-title">Sort:</p>
                    <p class="forum-sort-selected">New ▼</p>

                    <div class="forum-sort-options">
                        <label class="forum-sort-option-item">
                            <input type="radio" name="sort" value="newest">
                            <p>Newest</p>
                        </label>

                        <label class="forum-sort-option-item">
                            <input type="radio" name="sort" value="oldest">
                            <p>Oldest</p>
                        </label>
                    </div>
                </div>

                <input id="forum-search" type="text" name="search" placeholder="Search...">
                <div id="forum-search-exit"><i class="fas fa-times"></i></div>


                <div id="forum-search-icon">
                    <i class="fas fa-search fa-2x"></i>
                </div>
            </form>

            <div id="create-new-post" data-href="<?php echo is_user_signedin() ? "new_post.php" : "login.php"; ?>">
                <img src="img/add.svg" alt="Add">
                <p>New post</p>
            </div>

            <div id="all-forum-posts">
                <?php
                $posts = get_all_posts($database_main);
                for ($i = 0; $i < count($posts); $i++) {
                    $post = $posts[$i];
                ?>
                <div class="forum-post">
                    <div class="forum-author">
                        <a href="#"><?php echo $post->author->username ?></a>
                        <p><?php echo format_time_data($post->created_date); ?> ago</p>
                    </div>

                    <a class="forum-title" href="view_post.php?p=<?php echo $post->id;?>">
                        <p><?php echo $post->title; ?></p>
                    </a>
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
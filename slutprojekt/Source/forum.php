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
    <?php
        $search = "";
        if(isset($_GET["q"])) 
        {
            $search = $_GET["q"];    
        }

        $sortOrder = "DESC";
        if(isset($_GET["sort"]))
        {
            $sort = $_GET["sort"];
            if($sort == "newest") 
            {
                $sortOrder = "DESC";
            } 
            else if($sort == "oldest") 
            {
                $sortOrder = "ASC";    
            }
        }
    ?>

    <div id="container">
        <?php include "template/header.php" ?>

        <main>
            <form class="forum-search-bar" action="forum.php" method="get">
                <div id="forum-sort">
                    <p class="forum-sort-title">Sort:</p>
                    <p class="forum-sort-selected">New ▼</p>

                    <div class="forum-sort-options">
                        <label class="forum-sort-option-item">
                            <input class="forum-sort-option-item-radio" type="radio" name="sort" value="newest"
                                <?php echo isset($_GET["sort"]) && $_GET["sort"] == "newest" ? "checked" : ""?>>
                            <p>Newest</p>
                        </label>

                        <label class="forum-sort-option-item">
                            <input class="forum-sort-option-item-radio" type="radio" name="sort" value="oldest"
                                <?php echo isset($_GET["sort"]) && $_GET["sort"] == "oldest" ? "checked" : ""?>>
                            <p>Oldest</p>
                        </label>
                    </div>
                </div>

                <input id="forum-search" type="text" name="q" placeholder="Search...">
                <div id="forum-search-exit"><i class="fas fa-times"></i></div>


                <div id="forum-search-icon">
                    <i class="fas fa-search fa-2x"></i>
                </div>
            </form>

            <div id="create-new-post" data-href="<?php echo $auth->IsUserLoggedIn() ? "new_post.php" : "login.php"; ?>">
                <i class="fas fa-plus fa-3x"></i>
                <p>New post</p>
            </div>

            <div id="all-forum-posts">
                <?php
                $posts = $forum->GetAllPosts("WHERE forum_posts.pTitle LIKE '%$search%'", $sortOrder, "LIMIT 10", "OFFSET 0");
                for ($i = 0; $i < count($posts); $i++) 
                {
                    $post = $posts[$i];
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
            </div>
        </main>

        <?php include "template/footer.php" ?>

        <script>
        $(".forum-sort-option-item-radio").change(() => {
            $(".forum-search-bar").submit();
        });
        </script>
    </div>
</body>

</html>
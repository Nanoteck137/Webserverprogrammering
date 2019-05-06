<?php
    session_start();
    require_once("private/database.php");
    require_once("private/user.php");
?>

<!DOCTYPE html>
<html>

<head>
    <?php include "template/head.php" ?>
    <link rel="stylesheet" href="css/pages/view_profile.css">
    <link rel="stylesheet" href="css/common/forum.css">
</head>

<body>
    <div id="container">
        <?php include "template/header.php" ?>

        <main>
            <div id="profile-info">
                <img id="profile-pic" src="img/profile_pic.jpg" alt="Profile Pic" width="250">
                <p id="profile-info-name">Nanoteck137</p>
                <p id="profile-info-posts">100 posts</p>
                <p id="profile-info-comments">1000 comments</p>
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
                    for ($i = 0; $i < 10; $i++) {
                        ?>
                    <div class="forum-post">
                        <div class="forum-author">
                            <a href="#">Nanoteck137</a>
                            <p>1 hour ago</p>
                        </div>

                        <a class="forum-title" href="#">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reprehenderit, officia
                                blanditiis
                                autem ea sunt sint consequatur quaerat impedit necessitatibus neque cupiditate culpa
                                adipisci facilis expedita magnam eos cum velit fugiat.</p>
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
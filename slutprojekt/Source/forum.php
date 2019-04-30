<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "template/head.php" ?>
</head>

<body>
    <div id="container">
        <?php include "template/header.php" ?>

        <main>
            <form id="posts-sort" class="forum-search-bar" action="forum.php" method="get">
                <p class="forum-sort-title">Sort</p>
                <p class="forum-sort-selected">New</p>
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

                <input id="forum-search" type="text" name="search" value="Search">

                <input type="submit" value="Submit">
            </form>

            <div id="create-new-post" data-href="#">
                <img src="img/add.svg" alt="Add">
                <p>New post</p>
            </div>

            <div id="all-forum-posts">
                <?php
                for($i = 0; $i < 10; $i++) {
                ?>
                <div class="forum-post">
                    <div class="forum-author">
                        <a href="#">Nanoteck137</a>
                        <p>1 hour ago</p>
                    </div>

                    <a class="forum-title" href="#">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reprehenderit, officia blanditiis
                            autem ea sunt sint consequatur quaerat impedit necessitatibus neque cupiditate culpa
                            adipisci facilis expedita magnam eos cum velit fugiat.</p>
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
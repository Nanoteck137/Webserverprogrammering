<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "template/head.php" ?>
</head>

<body>
    <?php include "template/header.php" ?>

    <main>
        <div id="sorting">
            <div id="sorting-head">
                <div>
                    <img id="sorting-img-down" src="img/down-arrow.svg" alt="Sort">
                    <img id="sorting-img-up" src="img/up-arrow.svg" alt="Sort" class="hide">

                </div>
                <p id="sorting-current">Sorting: New Post</p>
            </div>

            <ul id="sorting-options">
                <li>Wooh1</li>
                <li>Wooh2</li>
                <li>Wooh3</li>
                <li>Wooh3</li>
            </ul>
        </div>

        <div id="create-new-post" data-href="#">
            <img src="img/add.svg" alt="Add">
            <p>New post</p>
        </div>

        <div id="all-forum-posts">
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
        </div>
    </main>


    <?php include "template/footer.php" ?>
</body>

</html>
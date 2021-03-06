<?php
    require_once("private/common.php");
    common_start();
?>

<?php

/*
    NOTE(patrik): Hantera upladdningen av profil bilden
*/
if(isset($_POST["submit"]))
{
    $targetPath = "uploads/";
    $targetExtention = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $targetFile = tempnam($targetPath, "img_") . "." . $targetExtention;
    $info = pathinfo($targetFile);

    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

    try 
    {
        $user = $auth->GetLoggedInUser();
        $user->ChangeProfilePicture($info["basename"]);
    } 
    catch(Exception $e) 
    {
        header("location: index.php");
        exit();
    }
}

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
        // NOTE(patrik): Hämta använderen för denna profilen
        $user = null;
        if(isset($_GET["p"])) 
        {
            try 
            {
                $user = $auth->GetUserById($_GET["p"]);
            }
            catch(AuthUserNotFoundException $e)
            {
                header("location: index.php");
                exit();
            }
        }
        else
        {
            header("location: index.php");
            exit();
        }

        // NOTE(patrik): Hämta alla inlägg som användern har gjort
        $posts = $forum->GetPostFromUser($user);

        //NOTE(patrik): Hämta alla kommentarer som användaren har gjort
        $comments = $forum->GetCommentsFromUser($user);
    ?>

    <div id="container">
        <?php include "template/header.php" ?>

        <main>
            <div id="profile-info">
                <?php

                // NOTE(patrik): Hämta vilken profil bild använder har default eller en egen
                $profilePicturePath = "img/default_profile_picture.jpg";
                if($user->profilePicture !== "") 
                {
                    $profilePicturePath = "uploads/" . $user->profilePicture;
                }
                ?>
                <img id="profile-pic" src="<?php echo $profilePicturePath ?>" alt="Profile Pic" width="250">

                <?php
                if($auth->IsUserLoggedIn() && $auth->GetLoggedInUser()->id === (int)$_GET["p"])
                {
                    
                ?>

                <button id="profile-picture-change">Change Profile Picture</button>
                <?php
                }
                ?>

                <p id="profile-info-name"><?php echo $user->username?></p>
                <p id="profile-info-posts"><?php echo count($posts); ?> post(s)</p>
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
                    //NOTE(patrik): Rendera all info om alla inlägg användaren har gjort
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

            <div class="modal">
                <div class="modal-content">
                    <div class="modal-exit">
                        <i class="fas fa-times fa-2x"></i>
                    </div>

                    <form action="view_profile.php" method="post" enctype="multipart/form-data">
                        <input class="form-input" type="file" name="image">
                        <input class="form-input" type="submit" value="Upload Image" name="submit">
                    </form>
                </div>
            </div>
        </main>

        <?php include "template/footer.php" ?>
        <script src="js/view_profile.js"></script>
    </div>
</body>

</html>
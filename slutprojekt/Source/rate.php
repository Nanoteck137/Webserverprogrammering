<?php
    require_once("private/common.php");
    common_start();
?>

<?php 

    //NOTE(patrik): Denna sida används för att hantera rating på ett post
    // Exempel: rate.php?r=upvote&p=1
    // r - Request(upvote/downvote)
    // p - Inläggs ID:t i databasen

    if(isset($_GET["p"]) && isset($_GET["r"]))
    {
        $postID = $_GET["p"];
        $request = $_GET["r"];

        try
        {
            $user = $auth->GetLoggedInUser();
            $post = $forum->GetPostById($postID);

            if($request === "upvote") 
            {
                $post->Upvote($user);
            } 
            else if($request === "downvote")
            {
                $post->Downvote($user);
            } 
            else 
            {
                //TODO(patrik): Error
            }

            header("location: view_post.php?p=$postID");
            exit();
        } 
        catch(Exception $e)
        {
            header("location: index.php");
            exit();
        }
    } 
    else
    {
        //TODO(patrik): Error
    }

?>
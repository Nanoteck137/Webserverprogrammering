<?php
    require_once("private/common.php");
    common_start();
?>

<?php 

    // Example: rate.php?r=upvote&p=1

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
        } 
        catch(ForumPostNotFoundException $e)
        {
            header("location: index.php");
            exit();
        }
    }

?>
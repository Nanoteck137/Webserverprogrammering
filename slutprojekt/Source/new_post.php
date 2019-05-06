<?php
    session_start();
    require_once("./private/database.php");
    require_once("./private/user.php");
?>

<!DOCTYPE html>
<html>

<head>
    <?php include "template/head.php" ?>
    <link rel="stylesheet" href="css/pages/new_post.css">
</head>

<body>
    <?php 
        if(!is_user_signedin()) 
        {
            header("location: login.php");
            exit();
        }
    ?>
    <div id="container">
        <?php include "template/header.php" ?>

        <main>
            <form action="new_post.php" method="get">
                <input class="form-input" id="title" name="title" type="text" placeholder="Title">
                <textarea class="form-input" id="content" name="content" cols="30" rows="10"></textarea>
                <button class="form-input">Preview</button>
                <input class="form-input" type="submit" value="Create post">
            </form>
        </main>

        <?php include "template/footer.php" ?>

        <script>
        /*let converter = new showdown.Converter();

        document.getElementById("test").addEventListener("input", (event) => {
            let html = converter.makeHtml(event.target.value);

            document.getElementById("result").innerHTML = html;
        });*/
        </script>
    </div>
</body>

</html>
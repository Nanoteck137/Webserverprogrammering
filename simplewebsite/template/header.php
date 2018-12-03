<div id="header">
    <div id="header-left">
        <a class="header-item" id="header-home" href="index.php"><p>Home</p></a>
        <!--<a class="header-item" href="index.php"><p>Home</p></a>-->
        <a class="header-item" href="posts.php"><p>Posts</p></a>
    </div>
    
    <div id="header-right">
        <?php
        if(isset($_SESSION["valid_login"]) && $_SESSION["valid_login"] === true) {
        ?>
            <a class="header-item" href="profile.php"><p>Profile</p></a>
            <a class="header-item" href="logout.php"><p>Logout</p></a>
        <?php
        } else {
        ?>
            <a class="header-item" href="login.php"><p>Login</p></a>
        <?php
        }
        ?>
    </div>
</div>
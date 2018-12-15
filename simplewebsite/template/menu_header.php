<div id="header" class="card">
    <div id="header-left">
        <a class="header-item" id="header-home" href="index.php"><p>Home</p></a>
        <!--<a class="header-item" href="index.php"><p>Home</p></a>-->
        <a class="header-item" href="posts.php"><p>Posts</p></a>
    </div>
    
    <div id="header-right">
        <?php
        if(is_logged_in()) {
            $user = get_user_data($dbc_website, get_user_id());
        ?>
            <a class="header-item" href="profile.php"><p><i class="material-icons">account_circle</i><?= $user->get_user_name();?></p></a>
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
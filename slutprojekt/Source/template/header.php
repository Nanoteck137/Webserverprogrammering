<header>
    <div id="header-main">
        <nav>
            <div class="hamburger-menu">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>

            <a id="header-logo-small" href="index.php"><img class="logo" src="img/logo.svg" alt="Logo" width="70"></a>

            <div id="desktop-menu-list">
                <a href="index.php">Home</a>
                <a href="forum.php">Forum</a>
                <a href="about.php">About Us</a>
            </div>

            <div id="profile-icon">
                <div id="profile-icon-button"><i class="fas fa-user fa-3x"></i></div>

                <div id="profile-menu" class="hide">
                    <?php
                    if($auth->IsUserLoggedIn()) 
                    {
                        $currentUser = $auth->GetLoggedInUser();
                    ?>
                    <p><?php echo $currentUser->username; ?></p>
                    <a href="view_profile.php?p=<?php echo $currentUser->id; ?>">
                        <i class="fas fa-user fa-1x"></i>
                        <p>Profile</p>
                    </a>

                    <a href="settings.php">
                        <i class="fas fa-cog fa-1x"></i>
                        <p>Settings</p>
                    </a>

                    <a href="logout.php">
                        <i class="fas fa-sign-in-alt fa-1x"></i>
                        <p>Log out</p>
                    </a>
                    <?php
                    }
                    else
                    { 
                    ?>
                    <a href="login.php">
                        <i class="fas fa-sign-in-alt fa-1x"></i>
                        <p>Log in</p>
                    </a>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </nav>

        <ul id="mobile-menu-list">
            <li class="menu-item"><a href="index.php">Home</a></li>
            <li class="menu-item"><a href="forum.php">Forum</a></li>
            <li class="menu-item"><a href="about.php">About Us</a></li>
        </ul>
    </div>
</header>
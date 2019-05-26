<?php
    require_once("private/common.php");
    common_start();
?>

<!DOCTYPE html>
<html>

<head>
    <?php include "template/head.php" ?>

    <link rel="stylesheet" href="css/pages/about_us.css">
</head>

<body>
    <div id="container">
        <?php include "template/header.php" ?>

        <main>
            <p id="about-us-title">About Us</p>
            <div id="about-us-profiles">
                <div class="about-us-profile">
                    <img src="img/about_us_img_3.png" alt="" width="200" style="border-radius: 100px">
                    <?php
                        $user = $auth->GetUserByUsername("BigHippo");
                    ?>
                    <div>
                        <a href="view_profile.php?p=<?php echo $user->id; ?>">Jimmy Berglund / BigHippo</a>
                        <p>Fontend Developer</p>
                    </div>
                </div>

                <div class="about-us-profile">
                    <img src="img/about_us_img_1.png" alt="" width="200" style="border-radius: 100px">
                    <?php
                        $user = $auth->GetUserByUsername("kingminecraft");
                    ?>
                    <div>
                        <a href="view_profile.php?p=<?php echo $user->id; ?>">Lars Strömberg / kingminecraft</a>
                        <p>Backend Developer</p>
                    </div>
                </div>

                <div class="about-us-profile">
                    <img src="img/about_us_img_2.png" alt="" width="200" style="border-radius: 100px">
                    <?php
                        $user = $auth->GetUserByUsername("lateMine");
                    ?>
                    
                    <div>
                        <a href="view_profile.php?p=<?php echo $user->id; ?>">Theodor Lindström / lateMine</a>
                        <p>Designer</p>
                    </div>
                </div>

                <div class="about-us-profile">
                    <img src="img/about_us_img_4.png" alt="" width="200" style="border-radius: 100px">
                    <?php
                        $user = $auth->GetUserByUsername("finnanut");
                    ?>
                    <div>
                        <a href="view_profile.php?p=<?php echo $user->id; ?>">Frank Olsson / finnanut</a>
                        <p>Cleaner</p>
                    </div>
                </div>
            </div>
        </main>

        <?php include "template/footer.php" ?>
    </div>
</body>

</html>
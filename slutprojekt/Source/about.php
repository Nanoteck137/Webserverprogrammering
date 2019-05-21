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
            <div id="about-us-profiles">
                <div class="about-us-profile">
                    <img src="img/test3.png" alt="" width="200" style="border-radius: 100px">
                    <p>Jimmy Berglund</p>
                    <p>Fontend Developer</p>
                </div>

                <div class="about-us-profile">
                    <img src="img/test.png" alt="" width="200" style="border-radius: 100px">
                    <p>Lars Strömberg</p>
                    <p>Backend Developer</p>
                </div>

                <div class="about-us-profile">
                    <img src="img/test2.png" alt="" width="200" style="border-radius: 100px">
                    <p>Theodor Lindström</p>
                    <p>Designer</p>
                </div>

                <div class="about-us-profile">
                    <img src="img/test4.png" alt="" width="200" style="border-radius: 100px">
                    <p>Frank Olsson</p>
                    <p>Cleaner</p>
                </div>
            </div>
        </main>

        <?php include "template/footer.php" ?>
    </div>
</body>

</html>
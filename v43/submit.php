<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>
</head>
<body>
    <?php
        session_start();
        
        if(isset($_POST["username"]) && 
            isset($_POST["mail"]) && 
            isset($_POST["password"])) 
        {
            $dbc_uppgift = mysqli_connect("localhost", "root", "", "uppgift");
        
            $username = $_POST["username"];
            $mail = $_POST["mail"];
            $password = $_POST["password"];

            $query = "INSERT INTO users(username, mail, password) VALUES ('$username', '$mail', '$password')";

            mysqli_query($dbc_uppgift, $query);
            
            $error = mysqli_errno($dbc_uppgift);
            //NOTE: 1062 error code is Duplicate entry for unique columns
            if ($error == 1062) {
                echo "<h1>Error</h1>";
                echo "<h3>Username or Mail is already in use</h3>";
            }
            else {
                echo "<h1>$username is now registered</h1>";

                $_SESSION["login_valid"] = true;
                $_SESSION["name"] = $username;

                $registered = true;
            }
        }
        else {
            header("location: index.php");
        }
    ?>

    <button id="profile">Go to profile page</button>

    <script src="submit.js"></script>
</body>
</html>
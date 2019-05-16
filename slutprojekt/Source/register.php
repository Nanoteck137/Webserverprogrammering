<?php
    require_once("private/common.php");
    common_start();
?>

<?php

function validate_post_request(): bool
{
    return isset($_POST["name"]) && 
           isset($_POST["username"]) && 
           isset($_POST["email"]) && 
           isset($_POST["birthdate"]) && 
           isset($_POST["password"]) &&
           isset($_POST["confirm_password"]);
}

function create_empty_object() 
{
    $result = new stdClass();
    $result->name = "";
    $result->username = "";
    $result->email = "";
    $result->birthdate = "";
    $result->password = "";
    $result->confirm_password = "";

    $result->confirm_password_error = false;
    $result->username_taken = false;
    $result->email_in_use = false;
    $result->can_register = true;

    return $result;
}

function create_object(mysqli $database) 
{
    $result = create_empty_object();
    $result->name = $_POST["name"];

    //NOTE(patrik): Check if the username is taken    
    $username = $_POST["username"];
    
    $query = "SELECT * FROM users WHERE username='$username'";
    //TODO(patrik): Check errors
    $db_result = $database->query($query);
    if($db_result->num_rows === 1) 
    {
        $result->username_taken = true;
        $result->can_register = false;
        $result->username = "";
    } 
    else 
    {
        $result->username = $username;
    }

    //NOTE(patrik): Check if the email is in use
    $email = $_POST["email"];

    $query = "SELECT * FROM users WHERE email='$email'";
    //TODO(patrik): Check errors
    $db_result = $database->query($query);

    if ($db_result->num_rows === 1) 
    {
        $result->email_in_use = true;
        $result->can_register = false;
        $result->email = "";
    } 
    else 
    {
        $result->email = $email;
    }


    $result->birthdate = $_POST["birthdate"];
    $result->password = $_POST["password"];
    $result->confirm_password = $_POST["confirm_password"];

    if($result->password !== $result->confirm_password) 
    {
        $result->confirm_password_error = true;
        $result->can_register = false;
    }

    return $result;
}

$object = create_empty_object();

if (validate_post_request()) 
{
    $object = create_object($database_main);

    if($object->can_register) 
    {
        $name = $object->name;
        $username = $object->username;
        $email = $object->email;
        $password = $object->password;
        $birthdate = $object->birthdate;

        $query = "INSERT INTO users(name, username, email, password, birthdate) VALUES ('$name', '$username', '$email', '$password', '$birthdate')";
        //TODO(patrik): Check if theres was an error
        $database_main->query($query);

        $user = get_user_from_username($database_main, $username);
        signin($user);

        header("location: index.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <?php include "template/head.php" ?>

    <!-- TODO(patrik): Why login.css -->
    <link rel="stylesheet" href="css/pages/login.css">
</head>

<body>
    <div id="container">
        <?php include "template/header.php" ?>

        <main>
            <form action="register.php" method="post">

                <div id="login-space"></div>
                <p id="login-title">Register</p>

                <input class="form-input" type="text" name="name" placeholder="Name" required value="<?php echo $object->name; ?>">
                <input class="form-input <?php echo $object->username_taken === true ? "form-error" : "" ?>" type="text" name="username" placeholder="Username" required value="<?php echo $object->username; ?>">
                <input class="form-input <?php echo $object->email_in_use === true ? "form-error" : "" ?>"" type="email" name="email" placeholder="Email" required value="<?php echo $object->email; ?>">
                <input class="form-input" type="date" name="birthdate" required value="<?php echo $object->birthday; ?>">
                <input class="form-input" type="password" name="password" placeholder="Password" required>
                <input class="form-input <?php echo $object->confirm_password_error === true ? "form-error" : "" ?>" type="password" name="confirm_password" placeholder="Confirm Password" required>

                <p id="login-register-account">Register a account <a href="register.php">here</a></p>

                <div id="login-space"></div>

                <input class="form-input" type="submit" value="Register">
            </form>
        </main>

        <?php include "template/footer.php" ?>
    </div>
</body>

</html>
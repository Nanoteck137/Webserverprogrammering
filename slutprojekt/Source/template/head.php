<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>Stack Underflow</title>

<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js"
    integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="css/common/main.css">

<script src="js/libs/jquery.js"></script>
<script src="js/libs/showdown.min.js"></script>
<script src="js/theme.js"></script>

<script>
<?php

if($auth->IsUserLoggedIn())
{
    $user = $auth->GetLoggedInUser();
?>
let theme = themes["<?php echo $user->theme; ?>"];
<?php
    } 
    else 
    {
?>
let theme = themes["light"];
<?php
    }
?>

if (!theme) {
    theme = themes["light"];
}

changeTheme(theme);
</script>
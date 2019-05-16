<footer>
    <div id="footer-main">
        <p>Copyright &copy; 2019 Stack Underflow</p>
    </div>
</footer>

<script src="js/libs/jquery.js"></script>
<script src="js/libs/showdown.min.js"></script>
<script src="js/main.js"></script>

<script>

<?php
    $user = $auth->GetLoggedInUser();
?>

let theme = themes["<?php echo $user->theme ?>"];

if(!theme) 
{
    theme = themes["light"];
}

changeTheme(theme);

</script>
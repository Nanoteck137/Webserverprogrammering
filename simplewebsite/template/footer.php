<div id="footer" class="card-up">
    <p class="footer-item">Copyright EU(Article 13) &copy; 2018-2019</p>
</div>

<?php
if(is_logged_in()) {
    $user = get_user_data($dbc_website);
    $themeID = $user->get_theme_id();
} else {
    //Default theme
    $themeID = 1;
}

$query = "SELECT * FROM themes WHERE id=$themeID";
$result = mysqli_query($dbc_website, $query);
if(!$result) {
    header("location: 500.php");
    exit();
}
$row = mysqli_fetch_array($result);
?>

<script>
    let obj = JSON.parse('<?= $row["theme_content"]; ?>');
    let root = document.documentElement.style;

    root.setProperty("--primary-color", obj.primary.color.normal);
    root.setProperty("--primary-color-light", obj.primary.color.light);
    root.setProperty("--primary-color-dark", obj.primary.color.dark);

    root.setProperty("--primary-color-on", obj.primary.on.normal);
    root.setProperty("--primary-color-light-on", obj.primary.on.light);
    root.setProperty("--primary-color-dark-on", obj.primary.on.dark);

    root.setProperty("--secondary-color", obj.secondary.color.normal);
    root.setProperty("--secondary-color-light", obj.secondary.color.light);
    root.setProperty("--secondary-color-dark", obj.secondary.color.dark);

    root.setProperty("--secondary-color-on", obj.primary.on.normal);
    root.setProperty("--secondary-color-light-on", obj.primary.on.light);
    root.setProperty("--secondary-color-dark-on", obj.primary.on.dark);

</script>
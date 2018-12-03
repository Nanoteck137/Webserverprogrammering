<div id="footer">
    <p class="footer-item">Copyright EU(Article 13) &copy; 2018-2019</p>
</div>

<script>
    <?php 
        $user = get_user_data($dbc_website);
    ?>

    let obj = JSON.parse('<?php echo stripcslashes($user->get_settings());?>');
    console.log(obj);
    //document.documentElement.style.setProperty("--header-background-color", obj.header.backgroundColor);
</script>
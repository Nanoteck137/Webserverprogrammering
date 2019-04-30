<?php
    include "template_engine.php";
    
    $template = new \template_engine\Template("main");
    $template->set_var("test", "Wooh");
    $template->render();
?>
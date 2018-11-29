<?php
    require_once __DIR__ . '/../../vendor/autoload.php';
    $templates = League\Plates\Engine::create(__DIR__ . '/templates');

    $templates->addData(['company' => 'The Company Name'], 'layout');
    $templates->addData(["layoutName" => "Wow"], 'testLayout');
    echo $templates->render("test", []);
?>
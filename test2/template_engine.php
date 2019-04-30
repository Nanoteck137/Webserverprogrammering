<?php
namespace template_engine;

class Template {

    var $template = "";
    var $vars = array();

    public function __construct($template) {
        $this->template = $template;
    }

    public function set_var(string $name, string $value) {
        $this->vars[$name] = $value;
    }

    public function render($main) {
        $file_path = "templates/" . $this->template . ".phtml";
        if(file_exists($file_path)) {
            $file_content = \file_get_contents($file_path);

            foreach($this->vars as $key => $value) {
                $file_content = preg_replace('/{' . $key . '}/', $value, $file_content);
            }

            $main_file_path = "sites/" . $main . ".phtml";
            if(file_exists())

            $file_content = preg_replace('/{{MAIN}}/', $value, $file_content);

            eval("?>". $file_content ."<?php");
            //echo \htmlspecialchars($file_content);
        }
    }

}

?>
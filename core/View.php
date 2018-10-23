<?php 

namespace Core;

class View {
    
    public static function render($view, $args = []) {
        extract($args, EXTR_SKIP);

        $file = dirname(__DIR__) . "/resources/views/$view";

        if(is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

    public static function renderTemplate($template, $args = []) {
        static $twig = null;

        if($twig === null) {
            $loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/resources/views');
            $twig = new \Twig_Environment($loader);
        }

        echo $twig->render($template, $args);
    }
}
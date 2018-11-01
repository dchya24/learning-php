<?php 

namespace Core;

class View {
    
    public static function render($view, $args = []) {
        extract($args, EXTR_SKIP);
        $view = str_replace('.','/', $view);
        $file = dirname(__DIR__) . "/resources/views/$view.blade.php";

        if(is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

    public static function renderTemplate($template, $args = []) {
        static $twig = null;
        $dir =  '/resources/views';
        $file = "";

        $data = str_replace('.','/', $template);
        $array = explode('.', $template);

        if(count($array) == 1) {
            $file = $template;
        }
        elseif(count($array) > 1) {
            $a = 0;
            $int = count($array) - 1;

            foreach($array as $val) {
                $int != $a ? $dir .= "/$val" : $file = $val;
                $a++;
            }
        }

        if($twig === null) {
            $loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . $dir);
            $twig = new \Twig_Environment($loader);
        }

        echo $twig->render("$file.blade.php", $args);
    }
}
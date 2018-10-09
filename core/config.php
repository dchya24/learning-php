<?php 

  function config($string) {
   
      $env = parse_ini_file(__DIR__ . '/../.config');

      if(array_key_exists($string, $env )){
        return  $env[$string];
      }

  }

?>
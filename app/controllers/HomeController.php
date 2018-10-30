<?php 

namespace App\Controllers;

use Core\View;

class HomeController {
    public function index($id){
        die(var_dump($id));
        // View::renderTemplate('home.html', ['data' => 'data aku']);
    }

    public function noParams(){
        die(var_dump("noParams"));
    }
}
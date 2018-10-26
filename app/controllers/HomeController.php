<?php 

namespace App\Controllers;

use Core\View;

class HomeController {
    public function index(){
        View::renderTemplate('home.html', ['data' => 'data aku']);
    }
}
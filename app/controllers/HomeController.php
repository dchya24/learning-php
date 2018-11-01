<?php 

namespace App\Controllers;

use Core\View;


class HomeController {

    public function __construct() {
        if(array_key_exists('user',$_SESSION)) {
            return true;
        } else {
            redirect(base_url() . 'login');
        }
    }
    public function dashboard(){
        View::render('home');
    }

    public function upload(){
        die(var_dump($_SESSION));
    }

    
}
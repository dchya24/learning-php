<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;
use App\Models\User;

class LoginController extends Controller {
    public function login() {
        if(array_key_exists("user", $_SESSION)) {
            redirect(base_url(). 'dashboard');
        }

        View::render('auth.login');
    }

    public function register() {
        if(array_key_exists("user", $_SESSION)) {
            redirect(base_url(). 'dashboard');
        }
        View::render('auth.register');
    }

    public function postLogin(){
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            die(var_dump("Method allowed"));
        }

        extract($_POST);

        $user = new User;
        $data = $user->where(["email", $email])->first();

        if($data) {
            $verify = password_verify($password, $data['password']);
            if($verify === true) {
                $_SESSION['user'] = $data;
                redirect_back();
            }else{
                $_SESSION['message'] = [
                    "status" => "error",
                    "message" => "password salah"
                ];
    
                redirect_back();    
            }
        }
        else{
            $_SESSION['message'] = [
                "status" => "error",
                "message" => "User dengan email ini tidak ada"
            ];

            redirect_back();
        }
    }

    public function postRegister(){
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            die(var_dump("Method allowed"));
        }

        extract($_POST);
        $password = password_hash($password, PASSWORD_BCRYPT);

        $user = new User;
        $data = $user->insert([
                    "name" => $name,
                    "email" => $email,
                    "password" => $password
                ]);

        if($data) {
            $_SESSION['message'] = "Berhasil Mendaftar";

            redirect_back();
        }

    }
}
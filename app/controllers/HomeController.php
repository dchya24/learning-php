<?php 

namespace App\Controllers;

use Core\View;
use Core\Helper;
use App\Models\Arsip;
use Core\Connection;

class HomeController {

    public function __construct() {
        if(array_key_exists('user',$_SESSION)) {
            return true;
        } else {
            redirect(base_url() . 'login');
        }
    }
    public function dashboard(){
       $data = (Connection::querySelect("SELECT * FROM arsip ORDER BY uploaded_at ASC"));

        View::render('home', ["arsip" => $data]);
    }

    public function upload(){
        View::render('upload');
    }

    public function postUpload(){
        extract($_POST);
        extract($_FILES);

        $id = Helper::generateRandomString(32);
        $file_name = $file['name'][0];
        $file_url = $id. '-' .$file_name;
        $user_id = $_SESSION['user']['id'];

        $arsip = new Arsip;
        $insert = $arsip->insert([
            "id" => $id,
            "user_id" => $user_id,
            "name" => $name,
            "url" => $file_url,
            "type" => $file['type'][0]
        ]);
       if($insert){ 
            $upload = move_uploaded_file($file['tmp_name'][0], directory('could')."/$file_url");
            if($upload){
                $_SESSION['message'] = [
                    "status" => "berhasil",
                    "message" => "Berhasil Upload"
                ];

                redirect_back();
            }else{
                $_SESSION['message'] = [
                    "status" => "gagal",
                    "message" => "gagal diUpload"
                ];
                redirect_back();
            }
        }else{
           print_r('something Wrong!!');
       }
        die( var_dump($file) );
    }

    public function delete() {
        extract($_GET);

        $arsip = new arsip;
        $data = $arsip->find($id);

        $file_url = $data['url'];

        $delete = $arsip->destroy($id);

        if($delete) {
            unlink(directory("could/{$file_url}"));

            $_SESSION['message'] = [
                "status" => "berhasil",
                "message" => "Berhasil hapus arsip"
            ];

            redirect_back();
        } else{
            $_SESSION['message'] = [
                "status" => "gagal",
                "message" => "Something Wrong"
            ];
            var_dump('gagal', $delete);
        }
    }

    public function logout(){
        session_destroy();

        redirect_back();
    }
    
}
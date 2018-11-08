<?php 

namespace App\Controllers;

use Core\View;
use Core\Helper;
use App\Models\Arsip;
use App\Models\Data;
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

        $page = isset($_GET['page'])? (int)$_GET["page"] : 1;
        $halaman = isset($_GET['paginate']) ? (int) $_GET["paginate"] : 3;
        $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
        $query = "SELECT * FROM data inner join arsip ON arsip.id = data.arsip_id";
        $sql;

        if(array_key_exists("search", $_GET)) {
            if($_GET['search'] != null){
                $search = $_GET['search'];
                
                $query .= " WHERE arsip.name LIKE '%$search%' AND data.user_id=" .$_SESSION['user']['id'] . " limit $mulai, $halaman";
            }
            else {
                if($_GET['paginate'] != null) {
                    $query .= " WHERE data.user_id=" .$_SESSION['user']['id'] . " limit $mulai, $halaman";
                }
            }
        }else {
            $query .= " WHERE data.user_id=" .$_SESSION['user']['id'] . " ORDER BY arsip.uploaded_at ASC LIMIT $mulai, $halaman";            
        }

        $sql = Connection::querySelect("SELECT * FROM data inner join arsip ON arsip.id = data.arsip_id");


        $data = (Connection::querySelect($query));

        // die(var_dump($data));
        $total = mysqli_num_rows($sql);
        $pages = ceil($total/$halaman);

        // die(var_dump($data));

        View::render('home', ["arsip" => $data, "pages" => $pages, "current_page" => $page]);                   

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
           Connection::queryInsert("INSERT INTO data(user_id,arsip_id) VALUES($user_id, '$id')");
            $upload = move_uploaded_file($file['tmp_name'][0], directory('could')."/$file_url");
            if($upload){
                $_SESSION['message'] = [
                    "status" => "success",
                    "message" => "Berhasil Upload"
                ];

                redirect_back();
            }else{
                $_SESSION['message'] = [
                    "status" => "danger",
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

        $arsip = new Arsip;
        $data = $arsip->find($id);

        $file_url = $data['url'];

        $delete = $arsip->destroy($id);

        if($delete) {
            unlink(directory("could/{$file_url}"));

            $_SESSION['message'] = [
                "status" => "success",
                "message" => "Berhasil hapus arsip"
            ];

            redirect_back();
        } else{
            $_SESSION['message'] = [
                "status" => "danger",
                "message" => "Something Wrong"
            ];
            var_dump('gagal', $delete);
        }
    }

    public function settings() {
        View::render('settings');

        
    }

    public function postUpdateUser() {
        extract($_POST);
        $query = "UPDATE users SET name='$name'";

        $query .= " WHERE id=" . $_SESSION['user']['id'];

        $sql = Connection::querySelect($query);

        if($sql){
            $_SESSION['message'] = [
                "status" => "success",
                "message" => "Berhasil Update account"
            ];
            $_SESSION['user']['name'] = $name;
        }else {
            $_SESSION['message'] = [
                "status" => "danger",
                "message" => "gagal update account"
            ];
        }

        redirect_back();
        
    }

    public function logout(){
        session_destroy();

        redirect_back();
    }
    
}
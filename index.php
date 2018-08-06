<?php 

require('core/Model.php');

// use library\Model as Model;

Class User extends Model {
    protected $table = "users";
}
    
    $obj = new User;
    $getData = $obj->select(['name','email'])->where('id = ' . 1)->get();
    
    // print_r($getData);
        echo $getData;
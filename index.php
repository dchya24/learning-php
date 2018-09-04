<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php 

$DIR_NAME = __DIR__;

require('app/model/User.php');

use App\Model\User;


    echo "<br> <br>";

    $data = new User;
    
    $data = $data->all();  
    var_dump($data);  


?>
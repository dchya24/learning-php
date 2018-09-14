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

// var_dump(mcrypt_list_algorithms());
// var_dump(mcrypt_list_modes());

$DIR_NAME = __DIR__;

require('app/model/User.php');
require('core/Crypto.php');

use core\Crypto;

// $data = "this is string";

$data = [
    'array', 'data', 'string', 
];

$crypto = new Crypto;
$crypt_data = $crypto->encrypt($data);

var_dump($crypt_data);

$encrypt_data = $crypto->decrypt($crypt_data);
var_dump($encrypt_data);

?>
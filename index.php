<?php 

require('app/models/User.php');
require('core/Crypto.php');

// var_dump($_SERVER);
use App\Model\User;
use Core\Crypto;

$user = new User;
$data = $user->where(['id', '=',2])->get();

$crypto = new Crypto;

$encrypt = $crypto->encrypt($data);
var_dump($encrypt);

$decrypt = $crypto->decrypt($encrypt);


var_dump($decrypt);



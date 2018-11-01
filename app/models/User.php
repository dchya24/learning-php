<?php 
  
namespace App\Models;
// require('./core/Model.php');

use Core\Model;

class User extends Model{
  protected $table = "users";
  protected $fillable = ['name', 'email', 'password'];
}

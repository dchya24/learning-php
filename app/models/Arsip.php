<?php 
  
namespace App\Models;
// require('./core/Model.php');

use Core\Model;

class Arsip extends Model{
  protected $table = "arsip";
  protected $fillable = ['id', 'name', 'url'];
}

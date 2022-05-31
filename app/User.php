<?php
namespace App;

use System\DataBase\ORM\Model;


class User extends Model{
    
    protected $tabel = "users";
    protected $Fillabale = ['email','first_name','last_name','avatar','password',
    'status','is_active','user_type','verify_token','remember_token','remember_token_expire','username'];
    protected $Casts = [];


  
}
<?php
namespace App;


use System\DataBase\ORM\Model;

class Role extends Model{

    protected $tabel = "roles";
    protected $Fillabale = ['name'];
    protected $Casts = [];

    public function users(){

        return $this->belongsToMany('\App\user','user_role','id','role_id','user_id','id');

    }
}
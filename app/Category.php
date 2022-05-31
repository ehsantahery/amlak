<?php
namespace App;

use System\DataBase\ORM\Model;
use System\DataBase\Traits\HasSoftDelete;

class Category extends Model {

    use HasSoftDelete;
    protected $tabel = "categories";
    protected $Fillabale = ['name','parent_id'];
    protected $deletedAt = 'deleted_at';
    
    


    public function parent(){

        return $this->belongsTo("\App\category","parent_id","id");

    }


    public function ads()
    {
        return $this->hasMany('\App\Ads','cat_id','id');
    }


    public function post()
    {
        return $this->hasMany('\App\Post','cat_id','id');
    }
}
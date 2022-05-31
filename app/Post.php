<?php

namespace App;

use System\DataBase\ORM\Model;
use System\DataBase\Traits\HasSoftDelete;

class Post extends Model{

    use HasSoftDelete;
    protected $tabel = "posts";
    protected $Fillabale = ['title','body','user_id','cat_id','image','published_at','status'];
    protected $deletedAt = 'deleted_at';
    protected $Casts = [];

    public function category(){

        return $this->belongsTo('\App\Category','cat_id','id');

    }

    public function user(){
        
        return $this->belongsTo('\App\user','user_id','id');

    }


    public function coumment()
    {
        return $this->hasMany('\App\Comment','post_id','id');
    }

}
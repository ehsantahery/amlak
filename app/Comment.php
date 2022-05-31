<?php

namespace App;

use System\DataBase\ORM\Model;
class Comment extends Model
{
    protected $tabel = "comments";
    protected $Fillabale = ['user_id', 'post_id', 'comment', 'parent_id', 'status', 'approved'];
    protected $deletedAt = 'deleted_at';
    protected $Casts = [];


    public function post()
    {
        return $this->belongsTo('\App\Post','post_id','id');
    }

    public function user()
    {
        return $this->belongsTo('\App\User','user_id','id');
    }


    public function child()
    {
        return $this->hasMany('\App\Comment','parent_id','id');
    }
}

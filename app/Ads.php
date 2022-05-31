<?php

namespace App;

use System\DataBase\ORM\Model;
use System\DataBase\Traits\HasSoftDelete;

class Ads extends Model
{
    use HasSoftDelete;

    protected $tabel = "ads";
    protected $Fillabale = [
        'title', 'description', 'address', 'amount', 'image', 'floor', 'year', 'storeroom', 'balcony', 'area', 'room', 'toilet',
        'parking', 'tag', 'user_id', 'cat_id', 'status', 'sell_status', 'type', 'view'
    ];
    protected $deletedAt = "deleted_at";


    public function category()
    {
        return $this->belongsTo('App\Category', 'cat_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


    public function galleries()
    {
        return $this->hasMany('App\Gallery', 'advertise_id', 'id');
    }




    public function balcony()
    {
        return $this->balcony == 0 ? 'ندارد' : 'دارد';
    }

    public function sellstatus()
    {
        return ($this->sell_status == 0) ? 'خرید' : 'اجاره';
    }


    public function sellstatusBtn()
    {
        return ($this->sell_status == 0) ? 'sale' : 'rent';
    }

    public function parking()
    {
        return $this->balcony == 0 ? 'ندارد' : 'دارد';
    }

    public function type()
    {
        switch ($this->type) {
            case '0':
                return 'اپارتمان';

            case '1':
                return 'ویلایی';
            case '2':
                return 'زمین';

            case '3':
                return 'سوله';
        }
    }


    public function storeroom()
    {
        switch ($this->storeroom) {
            case '0':
                return "ندارد";
               
            case '1':
                return "دارد";
               
        }
    }
}

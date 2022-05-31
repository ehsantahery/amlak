<?php
namespace App;

use System\DataBase\ORM\Model;
use System\DataBase\Traits\HasSoftDelete;

class Slider extends Model
{
    use HasSoftDelete;
    
    protected $Fillabale = ['title','url','address','amount','body','image'];
    protected $tabel = "slides";
    protected $deletedAt = "deleted_at";
}
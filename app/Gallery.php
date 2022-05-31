<?php
namespace App;

use System\DataBase\ORM\Model;
use System\DataBase\Traits\HasSoftDelete;

class Gallery extends Model
{
    use HasSoftDelete;
    protected $tabel = "galleries";
    protected $Fillabale = ['image','advertise_id'];
    protected $deletedAt = "deleted_at";


}
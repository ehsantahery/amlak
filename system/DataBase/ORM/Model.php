<?php
namespace System\DataBase\ORM;

use System\DataBase\Traits\HasAttribute;
use System\DataBase\Traits\HasCrud;
use System\DataBase\Traits\HasMethodCaller;
use System\DataBase\Traits\HasQuaryBuilder;
use System\DataBase\Traits\HasRealationShip;

abstract class Model{

    use HasCrud,HasAttribute,HasMethodCaller,HasQuaryBuilder,HasRealationShip;
    
    protected $tabel;
    protected $Fillabale = [];
    protected $Hidden = [];
    protected $Casts = [];
    protected $primarykey = 'id';
    protected $CreatedAt = "created_at";
    protected $UpdatedAt = "updated_at";
    protected $deletedAt = null;
    public $Collection = [];
   
  
}



?>
<?php

namespace System\DataBase\Traits;


trait HasMethodCaller
{

    private $allmethod = [
        'delete','create', 'update', 'get', 'find', 'all', 'where', 'whereOr', 'whereNull', 'whereNotNull',
        'whereIn', 'limit', 'orderBy', 'paginate'
    ];
    private $allowmethod = [
        'delete','create', 'update', 'get', 'find', 'all', 'where', 'whereOr', 'whereNull', 'whereNotNull',
        'whereIn', 'limit', 'orderBy', 'paginate'
    ];



    public function __call($method, $argms)
    {

        return $this->callmethod($this, $method, $argms);
    }



    public static function __callStatic($method, $argms)
    {
       
        $classname = get_called_class();
        $instans = new $classname;
        return $instans->callmethod($instans, $method, $argms);
    }

    private function callmethod($object, $method, $argms)
    {


        $suffix = "Method";
        $methodname = $method . $suffix;
        if (in_array($method, $this->allowmethod) == true) {

           return call_user_func_array(array($object, $methodname), $argms);

        }
    }


    protected function SetallowMethod($array)
    {
       
        $this->allowmethod = $array;
        
    }
}

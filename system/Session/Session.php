<?php
namespace System\Session;

class Session{




    public function set($name,$value){
        $_SESSION[$name] = $value;
    }


    public function get($name){
        return isset($_SESSION[$name]) ? $_SESSION[$name] : false;
    }


    public function remov($name){
        if(isset($_SESSION[$name]))
        unset($_SESSION[$name]);
    }


    public static function __callStatic($name, $arguments)
    {
        $instans = new self();
        return call_user_func_array([$instans,$name],$arguments);
    }

}
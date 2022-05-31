<?php

namespace System\Config;

use Exception;

class Config
{

    private static $instans;
    private $config_nested_array = [];
    private $config_dot_array = [];

    private function __construct()
    {

        $this->InitialConfigArray();
    }

    private function InitialConfigArray()
    {
        $configPath = dirname(dirname(__DIR__)) . "/config/";
       
        foreach (glob($configPath ."*.php") as $configfile) {
            
            $config = require $configfile;
            $key = $configfile;
            $key = str_replace($configPath, '', $key);
            $key = str_replace('.php', '', $key);
            $this->config_nested_array[$key] = $config;
          
        }

        $this->initialdefaulValues();
        $this->config_dot_array = $this->Array_dot($this->config_nested_array);
    }


    private function initialdefaulValues()
    {
        $temperari = str_replace($this->config_nested_array['app']['base_url'], '', explode('?', $_SERVER['REQUEST_URI'])[0]);
        $temperari === "/" ? $temperari = "" : $temperari = substr($temperari, 1);
        $this->config_nested_array['app']['CURRENT_RUTE'] = $temperari;
    }


    private function Array_dot($array, $return_array = array(), $return_key = "")
    {

        foreach ($array as $key => $value) {



            if (is_array($value)) {
                $return_array = array_merge($return_array, $this->Array_dot($value, $return_array, $return_key . $key . '.'));
            } else {

                $return_array[$return_key . $key] = $value;
            }
        }

        return $return_array;
    }






    private static function getInstans()
    {

        if (empty(self::$instans)) {

            self::$instans = new self();
        }
        return self::$instans;
    }



    public static function get($key)
    {

        $instans = self::getInstans();
        if (isset($instans->config_dot_array[$key])) {
            return $instans->config_dot_array[$key];
        } else {
            throw new Exception(" [" . $key . " not exist in config array  ]");
        }
    }
}

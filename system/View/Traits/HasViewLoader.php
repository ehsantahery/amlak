<?php
namespace System\View\Traits;

use Exception;
use System\Config\Config;

trait HasViewLoader{

    public $ViewArray = [];


    public function viewloader($dir){

       
        $dir = trim($dir," .");
        $dir = str_replace(".",'/',$dir);
      
      
        if(file_exists(str_replace('\\','/',dirname(dirname(dirname(__DIR__)))."/resorces/view/".$dir.".blade.php")))
        {

            $this->registerView($dir);
            $content = htmlentities(file_get_contents(str_replace('\\','/',dirname(dirname(dirname(__DIR__)))."/resorces/view/".$dir.".blade.php")));
            return $content;
         
           
        }
        else
        {
           
            throw new Exception("[error in viewloader]");
           
           
        }
    }


    private function registerView($view){
       
        array_push($this->ViewArray,$view);
      
    }
}
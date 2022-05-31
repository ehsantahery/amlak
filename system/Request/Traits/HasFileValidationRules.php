<?php

namespace System\Request\Traits;

trait HasFileValidationRules
{


    protected function fillValidation($name, $rulearray)
    {
        foreach ($rulearray as $rule) {

            if ($rule == "requierd") {
                $this->filerequierd($name);
            } elseif (strpos($rule, "mimes:") === 0) {

                $rule = str_replace("mimes:", "", $rule);
                $rule = explode(",", $rule);
                $this->FileType($name, $rule);
            } elseif (strpos($rule, "max:") === 0) {
                $rule = str_replace("max:", "", $rule);
                $this->maxFile($name, $rule);
            } elseif (strpos($rule, "min:") === 0) {
                $rule = str_replace("min:", "", $rule);
                $this->minFile($name, $rule);
            }
        }
    }


    protected function filerequierd($name)
    {
       

        if (!isset($this->file[$name]['name'])  || empty($this->file[$name]['name'])  && $this->checkfirstError($name)) {

            $this->setError($name, "ارسال فایل ضروری است");
        }
    }

    protected function FileType($name, $TypeArray)
    {
       
        if ($this->checkfirstError($name) && $this->checkFileExiste($name)) {

            $currenttypeFile = explode('/', $this->file[$name]['type']);
            
            if (!in_array($currenttypeFile[1], $TypeArray)) {

                $this->setError($name, "فرمت فایل را بصورت صحیح وارد کنید");
            }
        }
    }


    protected function maxFile($name,$size){
        $filesize = $size * 1024;

        if($this->checkfirstError($name) && $this->checkFileExiste($name)){

            if($this->file[$name]['size'] > $filesize  ){

                $this->setError($name,"سایز فایل بیشتر است از ".($filesize/1024)."kb");

            }

        }
    }


    protected function minFile($name,$size){

        $filesize = $size * 1024;

        if($this->checkfirstError($name)  && $this->checkFileExiste($name)){

            if($this->file[$name]['size'] < $filesize){
                $this->setError($name,"سایز فایل کمتر است از ".($filesize/1024)."kb");
            }
        }
    }
}

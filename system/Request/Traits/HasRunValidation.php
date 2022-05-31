<?php
namespace System\Request\Traits;


trait HasRunValidation{
    


    protected function errorRedirect(){

       
        if($this->errorExist == false){
            return $this->request;
        }
        return back();

    }


    private function checkfirstError($name){

        if(!errorExist($name) && !in_array($name,$this->errorValiabelName)){
            
            return true ;
        }
        return false;

    }


    private function checkFildExiste($name){

        return (isset($this->request[$name]) && !empty($this->request[$name])) ? true : false; 

    }



    private function checkFileExiste($name){

        if(isset($this->file[$name]['name'])){
            if(!empty($this->file[$name]['name'])){
                return true;
            }
        }
        return false;

    }



    private function setError($name,$errorMessege){
        array_push($this->errorValiabelName,$name);
        error($name,$errorMessege);
        $this->errorExist = true;
        
    }
}
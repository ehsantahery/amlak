<?php
namespace System\Request;

use System\Request\Traits\HasFileValidationRules;
use System\Request\Traits\HasRunValidation;
use System\Request\Traits\HasValidationRules;

class Request{

    use HasFileValidationRules,HasRunValidation,HasValidationRules;

    protected $errorExist = false;
    protected $request;
    protected $file = null;
    protected $errorValiabelName = [];


    public function __construct()
    {
        if(isset($_POST)){
            $this->postAttribute();
        }

        if(!empty($_FILES))
        $this->file = $_FILES;
        $rules = $this->rules();
        empty($rules) ? : $this->run($rules);
        $this->errorRedirect();
        
    }





    public function rules(){
       return [];
    }




    protected function run($rules){

   
        foreach($rules as $att => $value){
         
            $rulearray = explode('|',$value);
            if(in_array('file',$rulearray)){

                unset($rulearray[array_search('file',$rulearray)]);
                $this->fillValidation($att,$rulearray);
            }
            elseif(in_array('number',$rulearray)){

               
                $this->numberValidation($att,$rulearray);
            }
            else{

                $this->normalValidation($att,$rulearray);
            }
        }

    }



    public function fille($name){
      
       return isset($this->file[$name]) ? $this->file[$name] : false;
    }




    protected function postAttribute(){

        foreach($_POST as $key => $value){
            $this->$key = htmlentities($value);
            $this->request[$key] = htmlentities($value);
           
           
        }

    }

    public function all(){
        return $this->request;
    }


    
}
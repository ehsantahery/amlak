<?php
namespace System\View\Traits;


trait HasIncludeContents{


    private function checkIncludeContent(){

        while(1)
        {
            $includeNamearray = $this->findinclude();
            if(!empty($includeNamearray)){
                foreach($includeNamearray as $includeName){
                    $this->initialinclude($includeName);
                }
            }
            else
            {
                break;
            }

        }

    }


    private function findinclude(){

      
        $fileincludearray = [];
        preg_match_all("/@include+\('([^)]+)'\)/",$this->contans,$fileincludearray,PREG_UNMATCHED_AS_NULL);
        return isset($fileincludearray[1]) ? $fileincludearray[1] : false;
    }



    private function initialinclude($includeName){

        $this->contans = str_replace("@include('$includeName')",$this->viewloader($includeName),$this->contans);
      

       
    }
}
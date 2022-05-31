<?php

namespace System\DataBase\Traits;

use System\DataBase\DBconection\DBConnection;

trait HasSoftDelete
{

    protected function deleteMethod($id = null)
    {


        $object = $this;
        if ($id) {
            $this->restAllquary();
            $object = $this->findMethod($id);
        }
        $object->restAllquary();
        $object->setsql(" UPDATE " . $object->GetNameTabel() . " SET " . $this->Getattribute($this->deletedAt) . " = NOW()");
        $object->setwhere("AND", $this->Getattribute($object->primarykey) . " = ?");
        $object->addbindvalue($object->primarykey, $object->{$object->primarykey});
        return $object->addquary();
    }


    protected function allMethod()
    {

        $this->setsql(" SELECT " . $this->GetNameTabel() . ".* FROM" . $this->GetNameTabel());
        $this->setwhere("AND", $this->Getattribute($this->deletedAt) . " IS NULL");
        $statment = $this->addquary();
        $data = $statment->fetchAll();
        if ($data) {
            $this->ArrayToObject($data);
            return $this->Collection;
        }

        return [];
    }



    protected function findMethod($id)
    {

        if ($id) {
            $this->restAllquary();
            $this->setsql(" SELECT " . $this->GetNameTabel() . ".* FROM " . $this->GetNameTabel());
            $this->setwhere("AND", $this->Getattribute($this->primarykey) . " = ?");
            $this->addbindvalue($this->primarykey, $id);
            $this->setwhere(" AND ", $this->Getattribute($this->deletedAt) . " IS NULL ");
            $statment = $this->addquary();
            $data = $statment->fetch();
            $this->allowMethod(['update', 'delete', 'get']);
            if ($data) {
                return $this->ArrayToAttributes($data);
                return null;
            }
        }
    }


    protected function getMethod($array = [])
    {

    
        if($this->getsql() == ''){
          
            if(empty($array)){
                $fields = $this->GetNameTabel().'.*';
            }
            else{
               
                foreach($array as $key => $field){
                  
                    $array[$key] = $this->Getattribute($field);
                }
                $fields = implode(' , ', $array);
            }
            $this->setsql("SELECT $fields FROM ".$this->GetNameTabel());
        }
        $this->setwhere("AND", $this->Getattribute($this->deletedAt)." IS NULL ");
        $statement = $this->addquary();
        
        $data = $statement->fetchAll();
        if ($data){
           $this->ArrayToObject($data);
           return $this->Collection;
        }
        return [];

           
    }


    


    


    
}

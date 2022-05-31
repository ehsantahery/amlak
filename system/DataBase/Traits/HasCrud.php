<?php

namespace System\DataBase\Traits;


use System\DataBase\DBconection\DBConnection;

trait HasCrud
{


    protected function createMethod($values)
    {
        $values = $this->arrayToencodvalu($values);
        $this->ArrayToAttributes($values, $this);
        return $this->saveMethod();
    }


    protected function updateMethod($values)
    {

        $values = $this->arrayToencodvalu($values);
        $this->ArrayToAttributes($values, $this);

        return $this->saveMethod();
       
    }

    protected function deleteMethod($id = null)
    {

        $object = $this;
        $this->restAllquary();
        if ($id) {

           
            $object = $this->findMethod($id);
            $this->restAllquary();
        }
        $this->setsql("DELETE FROM" . $object->GetNameTabel());
        $this->setwhere("AND", $this->Getattribute($object->primarykey) . " = ?");
        $this->addbindvalue($object->primarykey, $object->{$object->primarykey});

        return $this->addquary();
    }


    protected function orderByMethod($name, $expertion)
    {

        $this->setorderby($name, $expertion);
        $this->SetallowMethod(['limit', 'orderBy', 'get', 'paginate']);
        return $this;
    }


    protected function limitMethod($from, $number)
    {
      
        $this->setlimitby($from, $number);
        $this->SetallowMethod(['limit', 'get', 'paginate']);
        return $this;
    }


    protected function whereNotNullMethod($attribute, $value)
    {

        $condition = $this->Getattribute($attribute) . " IS NOT NULL";
        $this->addbindvalue($attribute, $value);
        $operation = "AND";
        $this->setwhere($operation, $condition);
        $this->SetallowMethod(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBY', 'get', 'paginate']);
        return $this;
    }

    protected function whereNullMethod($attribute)
    {


        $condition = $this->Getattribute($attribute) . " IS NULL ";
        $operation = "AND";
        $this->setwhere($operation, $condition);
        $this->SetallowMethod(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBY', 'get', 'paginate']);
        return $this;
    }


    protected function whereInMethod($attribute, $values)
    {



        if (is_array($values)) {
            $fildarray = [];
            foreach ($values as $vlue) {
                $this->addbindvalue($attribute, $vlue);
                array_push($fildarray, ' ?');
            }
            $condition = $this->Getattribute($attribute) . " IN (" . implode(' , ', $fildarray) . ")";
            $operation = "AND";
            $this->setwhere($operation, $condition);
            $this->SetallowMethod(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBY', 'get', 'paginate']);
            return $this;
        }
    }


    protected function whereOrMethod($attribute, $firstvalue, $secendvalue = null)
    {

        if ($secendvalue == null) {

            $condition = $this->Getattribute($attribute) . " = ?";
            $this->addbindvalue($attribute, $firstvalue);
        } else {
            $condition = $this->Getattribute($attribute) . " " . $firstvalue . " ?";
            $this->addbindvalue($attribute, $secendvalue);
        }

        $operation = "AND";
        $this->setwhere($operation, $condition);
        $this->SetallowMethod(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate']);
        return $this;
    }


    protected function whereMethod($attribute, $firstvalue, $secendvalue = null)
    {

       
        if ($secendvalue == null) {

            $condition = $this->Getattribute($attribute) . " = ?";
            $this->addbindvalue($attribute, $firstvalue);
        } else {
            $condition = $this->Getattribute($attribute) . " " . $firstvalue . " ?";
            $this->addbindvalue($attribute, $secendvalue);
        }

        $operation = "AND";
        $this->setwhere($operation, $condition);
        $this->SetallowMethod(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate']);
        return $this;
    }



    protected function allMethod()
    {
        $this->setsql("SELECT * FROM " . $this->GetNameTabel());
        $statment = $this->addquary();
        $dats = $statment->fetchAll();
        if ($dats) {
            $this->ArrayToObject($dats);
            return $this->Collection;
        }


        return [];
    }



    protected function findMethod($id)
    {

      
        $this->setsql("SELECT * FROM ".$this->GetNameTabel());
        $this->setwhere("AND", $this->Getattribute($this->primarykey) . " = ?");
        $this->addbindvalue($this->primarykey, $id);
        $statment = $this->addquary();
        $data = $statment->fetch();
        $this->SetallowMethod(['delete','update','save']);
        if ($data)
            return $this->ArrayToAttributes($data);
        return null;
    }

    protected function getMethod($array = [])
    {

      
        if ($this->getsql() == '') {
            if (empty($array)) {
                $fields = $this->GetNameTabel() . '.*';
            } else {
                foreach ($array as $key => $field) {
                    $array[$key] = $this->getAttributeName($field);
                }
                $fields = implode(' , ', $array);
            }
            $this->setSql("SELECT $fields FROM " . $this->GetNameTabel());
        }

        $statement = $this->addquary();
        $data = $statement->fetchAll();
        if ($data) {
            $this->ArrayToObject($data);
            return $this->Collection;
        }
        return [];


       
    }


    protected function paginateMethod($prepage)
    {

        $totalRoes = $this->getcont();
        $currentpage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $totalpage = ceil($totalRoes / $prepage);
        $currentpage = min($currentpage, $totalpage);
        $currentpage = max($currentpage, 1);
        $currentRow = ($currentpage - 1) * $prepage;
        $this->setlimitby($currentRow, $prepage);
        if ($this->Sql == '') {

            $this->setsql("SELECT " . $this->GetNameTabel() . ".* FROM " . $this->GetNameTabel());
        }


        $statment = $this->addquary();
        $data = $statment->fetchAll();
        if ($data) {
            $this->ArrayToObject($data);
            return $this->Collection;
        }
        return [];
    }

    protected function saveMethod()
    {
       
        $fillstring = $this->fill();

        if (!isset($this->{$this->primarykey})) {

            $this->setsql("INSERT INTO " . $this->GetNameTabel() . " SET $fillstring ," . $this->Getattribute($this->CreatedAt) . " =NOW()");
        } else {
            $this->setsql("UPDATE " . $this->GetNameTabel() . " SET " . $fillstring . "," . $this->Getattribute($this->UpdatedAt) . " =NOW()");
            $this->setwhere("AND", $this->Getattribute($this->primarykey) . " = ? ");
            $this->addbindvalue($this->primarykey, $this->{$this->primarykey});
        }
        $this->addquary();
        $this->restAllquary();



        if (!isset($this->{$this->primarykey})) {

            $object = $this->findMethod(DBConnection::newInsertId());
            $defultvars = get_class_vars(get_called_class());
            $allvars = get_object_vars($object);
            $diffrentarray = array_diff(array_keys($allvars), array_keys($defultvars));
            foreach ($diffrentarray as $attribute) {
                
                $this->IncastAttribute($attribute) == true ? $this->RegisterAttribute($this, $attribute, $this->CastencodeValue($attribute, $object->$attribute)) :
                    $this->RegisterAttribute($this, $attribute, $object->$attribute);
            }
        }

        $this->restAllquary();
        $this->SetallowMethod(['update', 'delete', 'get']);
        return $this;
    }

    protected function fill()
    {
       
        $fillarray = array();
        foreach ($this->Fillabale as $attribute) {

            if (isset($this->$attribute)) {
                if($this->$attribute === ""){
                    $this->$attribute = null;
                }
                array_push($fillarray, $this->Getattribute($attribute) . " = ? ");
                $this->IncastAttribute($attribute) == true ? $this->addbindvalue($attribute, $this->CastencodeValue($attribute, $this->$attribute)) :
                    $this->addbindvalue($attribute, $this->$attribute);
            }
        }
        $fillstring = implode(' ,', $fillarray);
        return $fillstring;
    }
}

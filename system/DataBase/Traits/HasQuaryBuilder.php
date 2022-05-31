<?php

namespace System\DataBase\Traits;

use System\DataBase\DBconection\DBConnection;

trait HasQuaryBuilder
{

    private $Sql;
    private $Where = [];
    private $OrderBy = [];
    private $LimitBy = [];
    private $BindValue = [];
    private $Values = [];

    protected function setsql($quary)
    {
        $this->Sql = $quary;
    }
    protected function getsql()
    {
        return $this->Sql;
    }
    protected function Resetsql()
    {
        $this->Sql = " ";
    }


    //where
    protected function setwhere($operation, $condition)
    {

        array_push($this->Where, ["operation" => $operation, "condition" => $condition]);
    }

    protected function geteher()
    {

        return $this->Where;
    }

    protected function resetwhere()
    {

        $this->Where = [];
    }


    //order by
    protected function setorderby($name, $expertion)
    {
        array_push($this->OrderBy, $name . ' ' . $expertion);
    }

    protected function resetorderby()
    {
        $this->OrderBy = [];
    }

    //limit by

    protected function setlimitby($from, $number)
    {
        $this->LimitBy['from'] = (int)$from;
        $this->LimitBy['number'] = (int)$number;
    }

    protected function resetlimitby()
    {
        unset($this->LimitBy['from']);
        unset($this->LimitBy['number']);
    }

    //add bindvalue
    protected function addbindvalue($attribute, $value)
    {

        $this->Values[$attribute] = $value;
        array_push($this->BindValue, $value);
    }

    protected function resetaddbindvalue()
    {
        $this->Values = [];
        $this->BindValue = [];
    }

    protected function restAllquary()
    {
        $this->Resetsql();
        $this->resetwhere();
        $this->resetorderby();
        $this->resetlimitby();
        $this->resetaddbindvalue();
    }


    public function addquary()
    {
        $quary = '';
        $quary .= $this->Sql;

        if (!empty($this->Where)) {
            $wherstring = " ";
            foreach ($this->Where as $where) {
                $wherstring == " " ? $wherstring .= $where['condition'] :
                    $wherstring .= " " . $where['operation'] . " " . $where['condition'];
            }
            $quary .= " WHERE " . $wherstring;
        }


        if (!empty($this->OrderBy)) {

            $quary .= " ORDER BY " . implode(', ', $this->OrderBy);
        }

        if (!empty($this->LimitBy)) {

            $quary .= " LIMIT " . $this->LimitBy['from'] . " , " . $this->LimitBy['number'] . " ";
        }


        $quary .= " ;";
        // echo "<br>" . $quary . "<hr>";
        $dbconectinstans = DBConnection::getDBConnectionInstance();
        $statment = $dbconectinstans->prepare($quary);

        sizeof($this->BindValue) > 0 ? $statment->execute($this->BindValue) : $statment->execute();
        return $statment;
       
        // if (sizeof($this->BindValue) > sizeof($this->Values)) {


        //     sizeof($this->BindValue) > 0 ? $statment->execute($this->BindValue) : $statment->execute();
        // } else {


        //     sizeof($this->Values) > 0 ? $statment->execute(array_values($this->Values)) : $statment->execute();
        // }
        // return $statment;
       
    }


    protected function getcont()
    {

        $quary = " ";
        $quary = "SELECT COUNT(*) FROM " . $this->GetNameTabel();
        if (!empty($this->Where)) {

            $wherstring = " ";
            foreach ($this->Where as $where) {
                $wherstring == " " ? $wherstring .= $where['condition'] :
                    $wherstring .= " " . $where['operation'] . " " . $where['condition'];
            }
            return $quary .= "WHERE" . $wherstring;
        }

        // echo $quary;
        $dbconectinstans = DBConnection::getDBConnectionInstance();
        $temperary = $dbconectinstans->prepare($quary);
        if (sizeof($this->BindValue) > sizeof($this->Values)) {
            sizeof($this->BindValue) > 0 ? $temperary->execute($this->BindValue) : $temperary->execute();
        } else {
            sizeof($this->Values) > 0 ? $temperary->execute(array_values($this->Values)) : $temperary->execute();
        }
        return $temperary->fetchColumn();
    }


    protected function GetNameTabel()
    {
        return ' `' . $this->tabel . '`';
    }

    protected function Getattribute($attribute)
    {
        return '`'.$this->tabel .'`' . '.`'. $attribute.'`';
    }
}

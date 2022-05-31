<?php

namespace System\Request\Traits;


use System\DataBase\DBconection\DBConnection;

trait HasValidationRules
{


    public function normalValidation($name, $rulearray)
    {



        foreach ($rulearray as $rule) {



            if ($rule == 'requierd') {
               
                $this->requierd($name);
            } elseif (strpos($rule, 'max:') === 0) {

                $rule = str_replace("max:", "", $rule);
                $this->maxStr($name, $rule);
            } elseif (strpos($rule, "min:") === 0) {

                $rule = str_replace("min:", "", $rule);
                $this->minStr($name, $rule);
            } elseif (strpos($rule, "exists:") === 0) {
                $rule = str_replace("exists:", "", $rule);
                $rule = explode(',', $rule);
                $key = isset($rule[0]) == false ? null : $rule[1];
                $this->exsistsIn($name, $rule[0], $key);
            } elseif (strpos($rule, "unique:") === 0) {
                $rule = str_replace('unique:', "", $rule);
                $rule = explode(':', $rule);
                $key = isset($rule[0]) == false ? null : $rule[1];
                $this->uniqueStr($name, $rule[0], $key);
                var_dump($rule);
            } elseif ($rule == "email") {
                $this->email($name);
            } elseif ($rule == "date") {
                $this->date($name);
            } elseif ($rule == "confirmed") {
                var_dump($rule);
                $this->confirm($name);
            }
        }
    }





    public function numberValidation($name, $rulearray)
    {

        foreach ($rulearray as $rule) {

            if ($rule == "requierd") {

                $this->requierd($name);
            } elseif (strpos($rule, "max:") === 0) {

                $rule = str_replace('max:', '', $rule);
                $this->maxNumber($name, $rule);
            } elseif (strpos($rule, "min:") === 0) {

                $rule = str_replace("min:", "", $rule);
                $this->minNumber($name, $rule);
            } elseif (strpos($rule, "exists:") === 0) {

                $rule = str_replace("exists:", "", $rule);
                $rule = explode(",", $rule);
                $key = isset($rule[1]) == false ? null : $rule[1];
                $this->exsistsIn($name, $rule[0], $key);
            } elseif ($rule == "number") {
                $this->number($name);
            }
        }
    }




    protected function maxStr($name, $count)
    {

        if ($this->checkFildExiste($name)) {
            if (strlen($this->request[$name]) >= $count && $this->checkfirstError($name)) {
                $this->setError($name, $count . " تعداد کاراکتر بزرگتر است از ");
            }
        }
    }

    protected function minStr($name, $count)
    {

        if ($this->checkFildExiste($name)) {
            if (strlen($this->request[$name] <= $count && $this->checkfirstError($name))) {
                $this->setError($name, $count . " تعداد کاراکتر کمتر است از ");
            }
        }
    }

    protected function maxNumber($name, $count)
    {

        if ($this->checkFildExiste($name)) {

            if ($this->request[$name] >= $count && $this->checkfirstError($name)) {
                $this->setError($name, $count . " تعداد کاراکتر بزرگتر است از ");
            }
        }
    }



    protected function minNumber($name, $count)
    {

        if ($this->checkFildExiste($name)) {
            if ($this->request[$name] <= $count && $this->checkfirstError($name)) {
                $this->setError($name, $count . " تعداد کاراکتر کمتر است از ");
            }
        }
    }



    protected function requierd($name)
    {



        if ((!isset($this->request[$name]) || $this->request[$name] === "") && ($this->checkfirstError($name) && $name == in_array($name, ['first_name', 'name', 'Name', 'First_Name']))) {

            $this->setError($name, "وارد کردن نام ضروری است");
        }

        if ((!isset($this->request[$name]) || $this->request[$name] === "") and $this->checkfirstError($name) and ($name == in_array($name, ['last_name', 'family', 'Last_Name', 'Family', 'famili', 'Famili']))) {

            $this->setError($name, "وارد کردن نام خانوادگی ضروری است");
        }



        if ((!isset($this->request[$name]) || $this->request[$name] === "") and $this->checkfirstError($name) and ($name == in_array($name, ['email', 'Email', 'mail']))) {

            $this->setError($name, "پر کردن ایمیل ضروری است");
        }



        if ((!isset($this->request[$name]) || $this->request[$name] === "") and $this->checkfirstError($name) and ($name == in_array($name, ['avatar', 'img', 'image', 'images', 'Image']))) {

            $this->setError($name, "پر کردن عکس ضروری است");
        }



        if ((!isset($this->request[$name]) || $this->request[$name] === "") and $this->checkfirstError($name) and ($name == in_array($name, ['password', 'pasword']))) {

            $this->setError($name, "وارد کردن رمز عبور ضروری است");
        }


        if ((!isset($this->request[$name]) || $this->request[$name] === "") and $this->checkfirstError($name) and ($name == in_array($name, ['confirm_password']))) {

            $this->setError($name, "تایید رمز عبور ضروری است");
        }

        if ((!isset($this->request[$name]) || $this->request[$name] === "") && $this->checkfirstError($name)) {

            $this->setError($name, "پر کردن این فیلد ضروری است");
        }
    }





    public function uniqueStr($name, $tabel, $fild = "id")
    {

        if ($this->checkFildExiste($name)) {
            if ($this->checkfirstError($name)) {
                $value = $this->$name;
                $sql = "SELECT COUNT(*) FROM $tabel WHERE $fild = ?";
                $statment = DBConnection::getDBConnectionInstance()->prepare($sql);
                $statment->execute([$value]);
                $result = $statment->fetchColumn();
                if ($result != 0) {
                    $this->setError($name, "ایمیل کاربر تکراری است");
                }
            }
        }
    }


    public function confirm($name)
    {

        if ($this->checkFildExiste($name)) {

            $cunfirm = "confirm_";
            $confirm_password = $cunfirm . $name;
            if (!isset($this->$confirm_password)) {

                $this->setError($name, "رمز عبور خود را تایید کنید");

            }
            elseif($this->$confirm_password != $this->$name){
               
                $this->setError($name, "رمز عبور شما همخوانی ندارد");
            }
        }
    }


    public function number($name)
    {

        if ($this->checkFildExiste($name)) {

            if (!is_numeric($this->request[$name]) && $this->checkfirstError($name)) {
                $this->setError($name, "فورمت را به صورت عددی وارد کنید");
            }
        }
    }




    public function date($name)
    {

        if ($this->checkFildExiste($name)) {
            if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $this->request[$name])  && $this->checkfirstError($name)) {

                $this->setError($name, "تاریخ را با فرمت صحیح وارد کنید");
            }
        }
    }


    public function email($name)
    {

        if ($this->checkFildExiste($name)) {

            if ((!filter_var($this->request[$name], FILTER_VALIDATE_EMAIL)) && $this->checkfirstError($name)) {

                $this->setError($name, "ایمیل را با فرمت صحیح وارد کنید");
            }
        }
    }




    public function exsistsIn($name, $tabel, $fild = "id")
    {

        if ($this->checkFildExiste($name)) {

            $value = $this->$name;
            $sql = "SELECT COUNT(*) FROM $tabel WHERE $fild = ?";
            $statment = DBConnection::getDBConnectionInstance()->prepare($sql);
            $result = $statment->execute([$value]);
            $result = $statment->fetchColumn();
            if ($result == 0 || $result === false) {

                $this->setError($name, "این فیلد نباید خالی باشد");
            }
        }
    }
}

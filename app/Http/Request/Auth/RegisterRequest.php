<?php
namespace App\Http\Request\AUth;

use System\Request\Request;

class RegisterRequest extends Request
{
    public function rules()
    {
        return [

            "first_name" => "requierd|max:100",
            "last_name" => "requierd|max:100",
            "email" => "requierd|email|max:100|unique:users:email",
            "avatar" => "requierd|file|mimes:jpeg,jpg,png|max:400",
            "password" => "requierd|min:8|confirmed"
        ];
    }
}
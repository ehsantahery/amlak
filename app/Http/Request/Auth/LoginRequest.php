<?php
namespace App\Http\Request\AUth;

use System\Request\Request;

class LoginRequest extends Request
{
    public function rules()
    {
        return [
            "email" => "requierd|max:200",
            "password" => "requierd"
        ];
    }
}
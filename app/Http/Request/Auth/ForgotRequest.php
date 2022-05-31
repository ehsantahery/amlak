<?php
namespace App\Http\Request\AUth;

use System\Request\Request;

class ForgotRequest extends Request
{
    public function rules()
    {
        return [
            "email" => "requierd|max:50|email"
        ];
    }
}
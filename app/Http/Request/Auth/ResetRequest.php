<?php

namespace App\Http\Request\AUth;

use System\Request\Request;

class ResetRequest extends Request
{

    public function rules()
    {
        return [
            "password" => "required|confirmed|min:8"
        ];
    }
}
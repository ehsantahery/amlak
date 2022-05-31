<?php
namespace App\Http\Request;

use System\Request\Request;

class RequestComment extends Request
{
    
    public function rules()
    {
        return [
            "comment" => "requierd|max:500"
        ];
    }
}
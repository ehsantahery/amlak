<?php
namespace App\Http\Request\Admin;

use System\Request\Request;

class CommentRequest extends Request
{
    public function rules()
    {
        return [
            "comment" => "requierd|max:500"
        ];
    }
}
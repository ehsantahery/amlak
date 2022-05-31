<?php
namespace App\Http\Request\Admin;

use System\Request\Request;

class SlideRequest extends Request
{

    public function rules()
    {
        if(methodfiled() == "put"){
            return [
                "title" => "requierd|max:100",
                "url" => "requierd|max:150",
                "address" => "requierd|max:270",
                "amount" => "requierd|number",
                "body" => "requierd|max:2000",
                "image" => "file|max:500|mimes:jpeg,jpg",
            ];
        }
        else
        {
            return [
                "title" => "requierd|max:100",
                "url" => "requierd|max:150",
                "address" => "requierd|max:270",
                "amount" => "requierd|number",
                "body" => "requierd|max:2000",
                "image" => "requierd|file|max:500|mimes:jpeg,jpg",
            ];
        }
    }
}
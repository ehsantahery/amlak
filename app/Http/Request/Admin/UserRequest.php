<?php namespace App\Http\Request\Admin;



use System\Request\Request;

class UserRequest extends Request
{
   
public function rules()
{
    return [
        "first_name" => "requierd|max:90",
        "last_name" => "requierd|max:90",
        "avatar" => "file|mimes:jpeg,jpg|max:100"
    ];
}

}
<?php
namespace App\Http\Request\Admin;

use System\Request\Request;

class PostRequest extends Request
{
    public function rules()
    {
       
        if(methodfiled() == "put"){

            return [
                "title" => "requierd|max:70",
                "body" => "requierd",
                "cat_id" => "requierd|exist:categories,id",
                "image" => "file|max:500|mimes:jpeg,jpg,gif,png",
                "published_at" => "requierd|date",
            ];
        }
        else
        {
            return [
                "title" => "requierd|max:70",
                "body" => "requierd",
                "cat_id" => "requierd|exist:categories,id",
                "image" => "requierd|file|max:500|mimes:jpeg,jpg,gif,png",
                "published_at" => "requierd|date",
            ];
        }
      
        
    }
}
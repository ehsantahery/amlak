<?php
namespace App\Http\Request\Admin;

use System\Request\Request;

class GalleryRequest extends Request
{
    public function rules()
    {
        return [
            "image" => "requierd|file|max:100|mimes:jpeg,jpg,gif,png",
        ];
    }
}
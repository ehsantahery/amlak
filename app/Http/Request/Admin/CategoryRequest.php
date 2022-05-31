<?php
namespace App\Http\Request\Admin;

use System\Request\Request;
class CategoryRequest extends Request{

    public function rules()
    {
        return [
            "name" => "requierd|max:100",
            "parent_id" => "exists:categories,id",
        ];
    }
}
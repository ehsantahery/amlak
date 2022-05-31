<?php
namespace App\Http\Request\Admin;

use System\Request\Request;

class AdsRequest extends Request
{
    public function rules()
    {
        if(methodfiled() === "put"){

            return [

                "title" => "requierd|max:100",
                "address" => "requierd|max:300",
                "image" => "file|max:500|mimes:jpeg,jpg,gif,png",
                "floor" => "requierd|number",
                "year" => "requierd|number",
                "amount" => "requierd|number",
                "room" => "requierd|number",
                "tag" => "requierd|max:100",
                "description" => "requierd|max:700",
                "storeroom" => "requierd|number",
                "balcony" => "requierd|number",
                "toilet" => "requierd|max:100",
                "sell_status" => "requierd|number",
                "type" => "requierd|number",
                "area" => "requierd|number",
                "parking" => "requierd|number",
                "cat_id" => "requierd|exist:categories,id",

            ];
        }
        else
        {
            return [
                "title" => "requierd|max:100",
                "address" => "requierd|max:300",
                "image" => "requierd|file|max:500|mimes:jpeg,jpg,gif,png",
                "floor" => "requierd|number",
                "year" => "requierd|number",
                "amount" => "requierd|number",
                "room" => "requierd|number",
                "tag" => "requierd|max:100",
                "description" => "requierd|max:700",
                "storeroom" => "requierd|number",
                "balcony" => "requierd|number",
                "toilet" => "requierd|max:100",
                "sell_status" => "requierd|number",
                "type" => "requierd|number",
                "area" => "requierd|number",
                "parking" => "requierd|number",
                "cat_id" => "requierd|exist:categories,id",
            ];

        }
    }
}
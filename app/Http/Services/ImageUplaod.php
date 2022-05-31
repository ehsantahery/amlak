<?php
namespace App\Http\Services;

use Intervention\Image\ImageManager;

class ImageUplaod {
    public static function imageuploadandfit($file,$path,$name,$witdh,$heigh){

        $path = trim($path,"\/")."/";
        $name = trim($name,"\/") . "." . pathinfo($file['name'],PATHINFO_EXTENSION);
        if(!is_dir($path)){
            
            if(!mkdir($path,0777,true)){
                die('images failud to upload');
            }

        }
        is_writable($path);
        $manager = new ImageManager(array('driver' => 'GD'));
        $image = $manager->make($file['tmp_name'])->fit($witdh,$heigh);
        $image->save($path.$name);
        return "/".$path.$name;
        
    }
}
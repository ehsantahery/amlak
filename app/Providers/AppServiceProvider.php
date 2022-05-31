<?php
namespace App\Providers;

use System\View\Composer;

use App\Category;
use App\Post;
use App\Role;
use App\User;
use App\Ads;
use App\Slider;

class AppServiceProvider extends provider{

    public function boot(){

        Composer::view('app.index',function(){
           $allsliders = Slider::all();
            $ads = Ads::all();
            $sumarea = 0;
            foreach($ads as $ad){
                $sumarea += $ad->area;
            }
            $AllAds = count($ads);
            $Alluser = (int)count(User::all());
            $Allpost = (int)count(Post::all());
            return [
                "sumarea" => $sumarea,
                "allads" => $AllAds,
                "alluser" => $Alluser,
                "allpost" => $Allpost,
                "allsliders" => $allsliders,
               
            ];
        });

        Composer::view('app.about',function(){
            $allsliders = Slider::all();
            return [
                "allsliders" => $allsliders,
            ];
        });


        Composer::view('app.allads',function(){
            $allsliders = Slider::all();
            return [
                "allsliders" => $allsliders,
            ];
        });

        Composer::view('app.ads',function(){
            $allsliders = Slider::all();
            return [
                "allsliders" => $allsliders,
            ];
        });

        Composer::view('app.allblog',function(){
            $allsliders = Slider::all();
            return [
                "allsliders" => $allsliders,
            ];
        });

        Composer::view('app.category',function(){
            $allsliders = Slider::all();
            return [
                "allsliders" => $allsliders,
            ];
        });


        Composer::view('app.blog',function(){
            $allsliders = Slider::all();
            return [
                "allsliders" => $allsliders,
            ];
        });



        Composer::view('app.search',function(){
            $allsliders = Slider::all();
            return [
                "allsliders" => $allsliders,
            ];
        });

    }

}
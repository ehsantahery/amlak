<?php
namespace App\Http\Controllers\Admin;

use App\Ads;
use App\Category;
use App\Gallery;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Request\Admin\AdsRequest;
use App\Http\Request\Admin\GalleryRequest;
use App\Http\Services\ImageUplaod;
use GuzzleHttp\Psr7\UploadedFile;
use System\Auth\Auth;

class AdsController extends AdminController
{

    public function index()
    {
        $ads = Ads::all();
        $categoris = Category::all();
        return view('admin.ads.index',compact('ads','categoris'));
    }


    public function create()
    {
        $categoris = Category::all();
        return view('admin.ads.create',compact('categoris'));
    }


    public function store()
    {
        $request = new AdsRequest;
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        $inputs['status'] = 0;
        $path = "images/ads/" . date("y/m/d");
        $name = date("y_m_d_h_i_s_"). rand(10,99);
        $inputs['image'] = ImageUplaod::imageuploadandfit($request->fille('image'),$path,$name,800,499);
        Ads::create($inputs);
        return redirect('admin/ads');
    }

    public function edit($id)
    {
        $categoris = Category::all();
        $ads = Ads::find($id);
        return view('admin.ads.edit',compact('categoris','ads'));
    }


    public function update($id)
    {
        $request = new AdsRequest;
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        $inputs['status'] = 0;
        $image = $request->fille('image');
        if($image['tmp_name'] != ""){
            $path = 'images/ads/'.date('y/m/d');
            $name = date('y_m_d_h_i_s_') . rand(10,99);
            $inputs['image'] = ImageUplaod::imageuploadandfit($request->fille('image'),$path,$name,800,499);
        }
        Ads::update(array_merge($inputs,["id" => $id]));
        redirect('admin/ads');

    }


    public function delete($id)
    {
       Ads::delete($id);
       back();
    }


    public function gallery($id)
    {
        $advertie = Ads::find($id);
        $galleris = Gallery::where('advertise_id',$id)->get();
        return view('admin.ads.gallery',compact('advertie','galleris'));
    }

    public function storeGalleryImage($id)
    {
        $request = new GalleryRequest;
        $inputs = [];
        $inputs['advertise_id'] = $id;
        $path = 'images/gallery/'.date('Y/M/D');
        $name = date('Y_M_D_H_I_S_') . rand(10,99);
        $inputs['image'] = ImageUplaod::imageuploadandfit($request->fille('image'),$path,$name,730,400);
        Gallery::create($inputs);
        back();

       

    }

    public function deleteGalleryImage($gallery_id)
    {
       Gallery::delete($gallery_id);
       back();
    }

}
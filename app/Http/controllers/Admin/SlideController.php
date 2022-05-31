<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\SlideRequest;
use App\Http\Services\ImageUplaod;
use App\Slider;

class SlideController extends AdminController
{

    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index',compact('sliders'));
    }



    public function create()
    {

        return view('admin.slider.create');
    }

    public function store()
    {
        $request = new SlideRequest();
        $inputs = $request->all();
        $path = "images/slider/".date("Y/M/D");
        $name = date("Y_M_D_H_I_S_").rand(10,99);
        $inputs['image'] = ImageUplaod::imageuploadandfit($request->fille('image'),$path,$name,1500,920);
        Slider::create($inputs);
        return redirect('admin/slider');
    }


    public function edit($id)
    {
       $slider = Slider::find($id);
       return view('admin.slider.edit',compact('slider'));
    }


    public function update($id)
    {
        $request = new SlideRequest();
        $inputs = $request->all();
        $file = $request->fille('image');
        if(!empty($file['tmp_name']) AND $file['tmp_name'] != ""){
            $path = "images/slider/". date("Y/M/D");
            $name = date("Y_M_D_H_I_S_") . rand(10,99);
            $inputs['image'] = ImageUplaod::imageuploadandfit($request->fille('image'),$path,$name,1500,920);
        }
        $inputs['id'] = $id;
        Slider::update($inputs);
        return redirect('admin/slider');
    }



    public function delete($id)
    {
        Slider::delete($id);
        back();
    }

}
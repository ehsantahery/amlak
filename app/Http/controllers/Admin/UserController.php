<?php
namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\UserRequest;
use App\Http\Services\ImageUplaod;
use App\User;

class UserController extends AdminController
{

    public function index()
    {
        $users = User::all();
        return view('admin.user.index',compact('users'));
    }


    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit',compact('user'));
    }



    public function update($id)
    {
        $request = new UserRequest();
        $inputs = $request->all();
        $updateabel = ['first_name','last_name'];
        $inputs = array_intersect_key($inputs,array_flip($updateabel));
        $file = $request->fille('avatar');
        if(!empty($file['tmp_name']) AND $file['tmp_name'] != ""){
            $path = "images/user/" . date("Y/M/D");
            $name = date("y_M_D_H_I_S_").rand(10,99);
            $inputs['avatar'] = ImageUplaod::imageuploadandfit($request->fille('avatar'),$path,$name,100,100);
        }
        User::update(array_merge($inputs,["id" => $id]));
        return redirect('admin/user');
    }



    public function approved($id)
    {
        $user = User::find($id);
        if($user->is_active == 0){
            User::update(['is_active' => 1,"id" => $id]);
        }
        else
        {
            User::update(['is_active' => 0 , "id" => $id]);
        }
        back();
    }
}
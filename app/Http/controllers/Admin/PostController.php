<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Request\Admin\PostRequest;
use App\Http\Services\ImageUplaod;
use App\Post;
use System\Auth\Auth;

class PostController extends AdminController
{

    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }


    public function create()
    {
        $catgorys = Category::all();
        return view('admin.post.create', compact('catgorys'));
    }


    public function store()
    {
        $request = new PostRequest;
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['status'] = 0;
        $path = "images/posts/" . date("y/m/d");
        $name = date("y_m_d_h_i_s_") . rand(10,99);
        $input['image'] = ImageUplaod::imageuploadandfit($request->fille('image'),$path,$name,800,499);
        Post::create($input);
        return redirect('admin/post');
       
       
       
        
    }


    public function edit($id)
    {
       $post = Post::find($id);
       $categorys = Category::all();
        return view('admin.post.edit',compact('post','categorys'));
    }


    public function update($id){

        $request = new PostRequest();
        $input = $request->all();
        $input['status'] = 0;
        $input['user_id'] = Auth::user()->id;
        $image = $request->fille('image');
        if(!empty($image['tmp_name'])){
          
            $path = "images/posts/".date("y/m/d");
            $name = date("y_m_d_h_i_s_"). rand(10,99);
            $input['image'] = ImageUplaod::imageuploadandfit($request->fille('image'),$path,$name,800,499);
        }
        
       Post::update(array_merge($input,["id" => $id]));
        return redirect('admin/post ');
     
       
    }

    public function delete($id)
    {

       Post::delete($id);
       return back();
    }
}

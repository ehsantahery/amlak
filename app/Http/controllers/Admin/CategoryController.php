<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Request\Admin\CategoryRequest;

class CategoryController extends AdminController
{


    public function index()
    {
        $categorys = Category::all();
        return view('admin.category.index', compact('categorys'));
    }

    public function create()
    {


        $categorys = Category::whereNull('parent_id')->get();
        return view('admin.category.create',compact('categorys'));
    }

    public function store()
    {
       $request = new CategoryRequest;
       $input = $request->all();
       if(empty($request->parent_id)) unset($input['parent_id']);
       Category::create($input);
       return redirect('admin/category');
      

    }

    public function edit($id)
    {
       $category = Category::find($id);
       $categorys = Category::all();
        return view('admin.category.edit',compact('category','categorys'));
    }

    public function update($id)
    {
       $request = new CategoryRequest;
       $input = $request->all();
       Category::update(array_merge($input,["id" => $id]));
       redirect('admin/category');
    }

    public function delete($id)
    {
     Category::delete($id); 

    }
}

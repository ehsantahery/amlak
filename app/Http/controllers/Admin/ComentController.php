<?php
namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Request\Admin\CommentRequest;
use App\User;
use System\Auth\Auth;

class ComentController extends AdminController
{

    public function index()
    {
        $coments = Comment::all();
        return view('admin.coment.index',compact('coments'));
    }


    public function show($id)
    {
        $coment = Comment::find($id);
        return view('admin.coment.show',compact('coment'));
    }


    public function approved($id)
    {
        $coment = Comment::find($id);
        if($coment->approved == 0){
            Comment::update(['id' => $id,'approved' => 1]);
        }
        else
        {
             Comment::update(['id' => $id,'approved' => 0]);
        }
        return back();
    }



    public function ansverd($id)
    {
        $coment = Comment::find($id);
        $request = new CommentRequest();
        $coments = $request->all();
        $coments['post_id'] = $coment->post_id;
        $coments['user_id'] = Auth::user()->id;
        $coments['parent_id'] = $coment->id;
        $coments['approved'] = 1;
        $coments['status'] = 0;
        Comment::create($coments);
        return redirect('admin/coment');

    }
}
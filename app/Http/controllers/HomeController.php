<?php

namespace App\Http\Controllers;

use App\Ads;
use App\Category;
use App\Comment;
use App\Http\Request\RequestComment;
use App\Post;
use App\Slider;
use System\Auth\Auth;
use System\DataBase\DBBuilder\DBBuilder;


class HomeController extends Controller
{

    public function index(){
        $slides = Slider::all();
        $newestAds = Ads::orderBy('created_at', 'desc')->limit(0, 6)->get();
        $bestAds = Ads::orderBy('view', 'desc')->orderBy('created_at', 'desc')->limit(0, 4)->get();
        $couments = Comment::all();
        return view('app.index', compact('posts', 'newestAds', 'bestAds','couments'));
    }

    public function postAjax()
    {
    
        $posts = Post::where('published_at','<=',date('Y-m-d H:i:s'))->orderBy('created_at','desc')->limit(0,3)->get();
        foreach($posts as $post){
          $post->user = $post->user()->first_name.' '.$post->user()->last_name;
          $post->publish = \Morilog\Jalali\Jalalian::forge($post->published_at)->format('%B %d ،%Y');
          $post->url = route('home.blog',[$post->id]) ;
          $post->body = html_entity_decode(substr($post->body,0,200));
          $post->commentnumber = count($post->coumment()->whereNull('parent_id')->get());
         
        }

        header('Content-type: application/json');
        $result = json_encode($posts,JSON_UNESCAPED_UNICODE);
        echo $result;
        exit;
    }



    public function about()
    {
        return view('app.about');
    }

    public function allAds()
    {
        $Allads = Ads::all();
        return view('app.allads', compact('Allads'));
    }


    public function ads($id)
    {
       
        $advertise = Ads::find($id);
        $gallerys = $advertise->galleries()->get();
        $Allads = Ads::where('id','!=',$advertise->id)->orderBy('created_at','desc')->limit(0,2)->get(); 
        $Allpost = Post::where('published_at','<=',date('Y-m-d H:i:s'))->orderBy('created_at','desc')->limit(0,3)->get();
        $categorys = Category::all();
        $ads['view'] = $advertise->view;
        $ads['view'] += 1;
        $ads['id'] = $id;
        Ads::update($ads);
        return view('app.ads',compact('advertise','Allads','Allpost','categorys','gallerys'));

    }

    public function allblog()
    {
        $posts = Post::all();
        return view('app.allblog', compact('posts'));
    }



    public function category($id)
    {

        $category = Category::find($id);
        $advertises = $category->ads()->get();
        $posts = $category->post()->get();
      
        return view('app.category',compact('advertises','category','posts'));
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }



    public function blog($id)
    {
        $post = Post::find($id);
        $couments = Comment::where('approved',1)->whereNull('parent_id')->where('post_id',$id)->get();
        $categorys = Category::all();
        $posts = Post::where('published_at','<=',date('Y-m-d H:i:s'))->orderBy('created_at','desc')->limit(0,4)->get();
        return view('app.blog',compact('couments','categorys','posts','post'));
       
    }


    public function search()
    {
        $search = '%' . $_GET['search'] . '%';
        $posts = Post::where('title','LIKE',$search)->get();
        $advertises = Ads::where('title','LIKE',$search)->get();
        $result = trim($search,'%');
        return view('app.search',compact('advertises','posts','result'));
    }



    public function comment($post_id)
    {
        $request = new RequestComment();
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['post_id'] = $post_id;
        $input['status'] = 0;
        $input['approved'] = 0;
        Comment::create($input);
        return back();
       
    }
  


   
   

    // public function comment($post_id)
    // {
    //     $request = new UserCommentRequest();
    //     $inputs = $request->all();
    //     $inputs['post_id'] = $post_id;
    //     $inputs['approved'] = 0;
    //     $inputs['status'] = 0;
    //     $inputs['user_id'] = Auth::user()->id;
    //     $comment = Comment::create($inputs);
    //     return back();
    // }

    // public function search()
    // {
    //     if(isset($_GET['search']))
    //     {
    //         $search = '%' . $_GET['search'] . '%';
    //         $ads = Ads::where('title', 'LIKE', $search)->whereOr('tag', 'LIKE', $search)->get();
    //         $posts = Post::where('title', 'LIKE', $search)->get();
    //         return view('app.search', compact('ads', 'posts'));
    //     }
    //     else{
    //         return back();
    //     }
    // }

    // public function ajaxLastPosts()
    // {
    //     //get data
    //     $posts = Post::where('published_at', '<=', date('Y-m-d H:i:s'))->orderBy('created_at', 'desc')->limit(0,4)->get();
    //     foreach($posts as $post)
    //     {
    //         $post->user = $post->user()->first_name . ' ' . $post->user()->last_name;
    //         unset($post->user_id);
    //         $post->created_at = \Morilog\Jalali\Jalalian::forge($post->created_at)->format('%B %d، %Y');
    //         $post->url = route('home.post', [$post->id]);
    //     }

    //     header('Content-type: application/json');
    //     $result = json_encode($posts, JSON_UNESCAPED_UNICODE);
    //     echo $result;
    //     exit;
    // }



}
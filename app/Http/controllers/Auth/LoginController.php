<?php

namespace App\Http\Controllers\Auth;

use App\Http\Request\AUth\LoginRequest;
use App\User;
use System\Auth\Auth;

class LoginController
{
    public function view()
    {
        return view('auth.login');
    }


    public function login()
    {
        Auth::logout();
        $request = new LoginRequest();
       
        if (Auth::loginByEmail($request->email,$request->password)) {
            $users = User::where('email', $request->email)->get();
          if($users[0]->user_type == "admin"){
            return redirect("admin/");
          }
          else
          {
            return redirect('/');
          }
            
           
        }
        else
        {
            back();
        }
      
      

    }


  
}

<?php
namespace App\Http\Controllers\Auth;

use App\Http\Request\AUth\ResetRequest;
use App\User;

class ResetController{

    public function view($token)
    {
        $user = User::where('remember_token',$token)->get();
        $user_token = $user[0]->remember_token_expire;
        if(empty($user[0]) && date('Y-m-d h:i:s') > $user_token)
        {
            die('لینک بازیابی اعتبار ندارد');
            
        }
        else
        {
            $token = $user[0]->remember_token;
            return view('auth.reset',compact('token'));
           
        }
          
        
    }






    public function Change($token)
    {
       $request = new ResetRequest();
       $inputs = $request->all();
       $user = User::where('remember_token',$token)->get();
       if(date('Y-m-d h:i:s') > $user[0]->remember_token_expire)
       {
           error('reset',"کاربر وجود ندارد");
           back();
       }

       if($inputs['password'] !== $inputs['confirm_password'])
       {
           
           error('reset',"رمز مطابقت ندارد");
           back();
       }

       $input['password'] = password_hash($inputs['password'],PASSWORD_DEFAULT);
       $input['id'] = $user[0]->id;
       User::update($input);
       return redirect('auth/login');
    }
}
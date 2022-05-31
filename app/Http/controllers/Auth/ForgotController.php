<?php
namespace App\Http\Controllers\Auth;

use App\Http\Request\AUth\ForgotRequest;
use App\Http\Services\MailServise;
use App\User;
use System\Session\Session;
use tidy;

class ForgotController
{

    public function view()
    {
        return view('auth.forgot');
    }


    public function forgot()
    {
      
       if(Session::get('forgot.time') != false && Session::get('forgot.time') > time()){
        error('forgot','بعد از ۲ دقیقه دیگر امتحان کنید');
        back();
       }
       else
       {
           Session::set('forgot.time',time() + 120);
          
           $request = new ForgotRequest();
           $inputs = $request->all();
           $user = User::where('email',$inputs['email'])->get();
           if(empty($user[0]) && $user[0]->email == ""){
               error('forgot',"ایمیل وارد شده وجود ندارد");
               back();
           }
           
           $inputs['remember_token'] = generateToken(); 
           $inputs['remember_token_expire'] = date('y-m-d h:i:s',strtotime(' + 10 min'));
           $inputs['id'] = $user[0]->id;
           User::update($inputs);
           $messege ='<div style="text-align:center">
           <h4>ایمیل باز یابی رمز عبور</h4>
           <p>کاربر محترم لطفا برای بازیابی رمز عبور خود بر روی لینک زیر کلیک کنید</p>
           <a href="'. route("auth.reset",[$inputs['remember_token']]).'">بازیابی رمز عبور</a></div>';
           MailServise::send($user[0]->email,"ایمیل بازیابی رمز عبور",$messege);
           die('ایمیل بازیابی با موفقیت ارسال شد');
          
       }
      
      
      
      
      
    
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Request\AUth\RegisterRequest;
use App\Http\Services\ImageUplaod;
use App\Http\Services\MailServise;
use App\User;

class RegisterController
{
    public function view()
    {
        return view('auth.register');
    }


    public function register()
    {
        $request = new RegisterRequest();
        $inputs = $request->all();
        $inputs['is_active'] = 0;
        $inputs['status'] = 0;
        $inputs['verify_token'] = generateToken();
        $inputs['user_type'] = 'user';
        $inputs['remember_token'] = null;
        $inputs['remember_token_expire'] = null;
        $inputs['password'] = password_hash($request->password, PASSWORD_DEFAULT);
        $path = "images/user/" . date("Y/M/D");
        $name = date("y_M_D_H_I_S_") . rand(10, 99);
        $inputs['avatar'] = ImageUplaod::imageuploadandfit($request->fille('avatar'), $path, $name, 100, 100);
        User::create($inputs);
        $massege =
            '<h1>ایمیل فعال سازی</h1>
       <p>کاربر گرامی ثبت نام شما با موفقیت انجام شد برای فعالسازی حساب کاربری لطفا بر روی لینک زی کلیک کنید</p>
       <p style="text-aline: center"><a href="' . route('auth.register.activation', [$inputs['verify_token']]) . '" >فعال سازی حساب کاربری</a></p>
       ';
        $emailsevise = new MailServise();
        $emailsevise::send($inputs['email'], 'ایمیل فعال سازی', $massege);
        return redirect('auth/login');
    }




    public function activation($token)
    {
        $user = User::where('verify_token', $token)->get();
        if (empty($token) and $user->verify_token != $token) {
            die('کد اعتبار ندارد');
        }
        $user = $user[0];
        $user->is_active = 1;
        $is_active['is_active'] = $user->is_active;
        $id['id'] = $user->id;
        User::update(array_merge($is_active, $id));
        die('حساب کاربری شما فعال شد');
        


    }


    
}

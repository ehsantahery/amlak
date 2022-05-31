<?php
namespace App\Http\Controllers\Auth;

use System\Auth\Auth;

class LogoutController{

    public function logout()
    {
       
        Auth::logout();
        return redirect('/');
    }
}
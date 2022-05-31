<?php

namespace App\Providers;


class SessionProvider extends provider
{

    public function boot()
    {
        session_start();
        if (isset($_SESSION['temporary_flash'])) unset($_SESSION['temporary_falsh']);
        if (isset($_SESSION['temporary_errorflash'])) unset($_SESSION['temporary_errorflash']);
        if (isset($_SESSION['old'])) unset($_SESSION['temporary_old']);



        if (isset($_SESSION['flash'])) {

            $_SESSION['temporary_flash'] = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }


       
        if (isset($_SESSION['errorflash'])) {
            $_SESSION['temporary_errorflash'] = $_SESSION['errorflash'];
            unset($_SESSION['errorflash']);
        }



        if (isset($_SESSION['old'])) {
            $_SESSION['temporary_old'] = $_SESSION['old'];
            unset($_SESSION['old']);
        }



        $parametr = [];
        $parametr = !isset($_GET) ? $parametr : array_merge($parametr, $_GET);
        $parametr = !isset($_POST) ? $parametr : array_merge($parametr, $_POST);
        $_SESSION['old'] = $parametr;
        unset($parametr);
    }
}

<!doctype html>
<html lang="en">

<head>
   @include('admin.layouts.head')
   @yield('head')
</head>

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul></ul>
                    </div>
                    <ul class="nav navbar-nav float-right">

                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600"><?= \System\Auth\Auth::user()->first_name.' '.\System\Auth\Auth::user()->last_name ?></span>
                                    <span class="user-status active">آنلاین </span></div><span><img class="round" src="<?= \System\Auth\Auth::user()->avatar ?>" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="<?= route('logout') ?>"><i class="feather icon-power"></i> خروج</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>



    @include('admin.layouts.sidbar')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

         @yield('content')

        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

   @include('admin.layouts.scripts')
   @yield('scripts')
</body>

</html>
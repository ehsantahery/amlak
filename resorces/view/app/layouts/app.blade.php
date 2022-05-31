<!DOCTYPE html>
<html lang="en">

<head>
   @include('app.layouts.header')
   @yield('header')
</head>

<body class="text-right">

    @include('app.layouts.navbar')

    @include('app.layouts.slider')





    @yield('content')







   @include('app.layouts.footer')






   <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>  

    @include('app.layouts.script')
    @yield('script')
    

</body>

</html>
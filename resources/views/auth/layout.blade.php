<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon"
        href="http://synicare.com/wp-content/uploads/2022/05/cropped-SYNICARE-LOGO-Feb-Icon-03.png">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" type="text/css" href="{{asset('auth/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('auth/css/auth.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('auth/images/Bg1.png');">
            <div class="wrap-login100 p-l-110 p-r-110 p-t-31 p-b-33">
                <a class="" href="{{ url('/') }}"><img
                        src="http://synicare.com/wp-content/uploads/2020/07/SYNICARE-LOGO-02.png"
                        class="img-fluid img-center p-b-4" alt="logo" /></a>
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
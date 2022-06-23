<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="http://synicare.com/wp-content/uploads/2022/05/cropped-SYNICARE-LOGO-Feb-Icon-03.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') || {{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{asset('dashboard/vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/vertical-layout-light/style.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/custom.css')}}">
    <script src="https://kit.fontawesome.com/2cf4d7f403.js" crossorigin="anonymous" defer></script>
    @livewireStyles
</head>

<body>
    <div id="app" class="container-scroller">
        <!-- navbar start -->
        @include('layouts.header')
        <!-- navbar end -->

        <div class="container-fluid page-body-wrapper">
            <!-- sidebar start -->
            @include('layouts.sidebar')
            <!-- sidebar end -->
            <!-- partial -->
            <div class="main-panel">
                <!-- content-wrapper starts -->
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- footer -->
                @include('layouts.footer')
                <!-- footer end-->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- <script src="{{ mix('/js/app.js') }}"></script> -->
    <script src="{{asset('dashboard/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('dashboard/js/off-canvas.js')}}"></script>
    <script src="{{asset('dashboard/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('dashboard/js/template.js')}}"></script>
    @stack('scripts')
    @livewireScripts
</body>

</html>
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ url('/') }}"><img src="http://synicare.com/wp-content/uploads/2020/07/SYNICARE-LOGO-02.png" class="mr-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}"><img src="http://synicare.com/wp-content/uploads/2020/07/SYNICARE-LOGO-02.png" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item">
                <a class="nav-link " href="javascript:void(0)">
                    {{auth()->user()->name}}
                </a>
            </li>
            @if(auth()->user()->date_of_birth)
            <li class="nav-item">
                <a class="nav-link mr-2" href="javascript:void(0)">
                    {{auth()->user()->date_of_birth->format('d-m-Y')}}
                </a>
            </li>
            @endif
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <img src="{{auth()->user()->image ? url('/').'/'.auth()->user()->image:asset('storage/images/user.jpg')}}" alt="profile" />
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{route('profile')}}">
                        <i class="ti-settings text-primary"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
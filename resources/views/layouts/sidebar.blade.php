<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @if(auth()->user()->role_id == 1)
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.dashboard')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.users.index')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.medications.index')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Medications</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.appointments.index')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Appointments</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.subscription')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Subscriptions</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.settings')}}">
                <i class="ti-settings menu-icon"></i>
                <span class="menu-title">Settings</span>
            </a>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link" href="{{route('user.medications.index')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Medications</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('user.appointments.index')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Appointments</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('user.subscription')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Subscriptions</span>
            </a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{route('profile')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Profile</span>
            </a>
        </li>
        <!-- @if(auth()->user()->role_id != 1)
        <li id="calender" class="nav-item mt-3">
            <strong class="text-primary">My Next Appointments</strong>
            <calender :appointments="{{$appointments}}"></calender>
        </li>
        @endif -->
    </ul>
</nav>
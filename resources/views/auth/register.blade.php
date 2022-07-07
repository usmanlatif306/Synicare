@extends('auth.layout')
@section('title', 'Register')
@section('content')

<form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('register') }}">
    @csrf

    <span class="login100-form-title">
        Create Account
    </span>
    <!-- first name -->
    <div class="wrap-input100 validate-input m-t-30">
        <input class="input100 @error('first_name') focus-error100 @enderror" type="text" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" required>
        <span class="focus-input100"></span>
    </div>
    @error('first_name')
    <div class="error m-t-5">{{$message}}</div>
    @enderror

    <!-- last name -->
    <div class="wrap-input100 validate-input m-t-30">
        <input class="input100 @error('last_name') focus-error100 @enderror" type="text" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" required>
        <span class="focus-input100"></span>
    </div>
    @error('last_name')
    <div class="error m-t-5">{{$message}}</div>
    @enderror

    <!-- Email -->
    <div class="wrap-input100 validate-input m-t-10">
        <input class="input100 @error('email') focus-error100 @enderror" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        <span class="focus-input100"></span>
    </div>
    @error('email')
    <div class="error m-t-5">{{$message}}</div>
    @enderror

    <!-- Password -->
    <div class="wrap-input100 validate-input m-t-10">
        <input class="input100 @error('password') focus-error100 @enderror" type="password" name="password" placeholder="Password" required>
        <span class="focus-input100"></span>
    </div>
    @error('password')
    <div class="error m-t-5">{{$message}}</div>
    @enderror

    <!-- confirm password -->
    <div class="wrap-input100 validate-input m-t-10">
        <input class="input100" type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <span class="focus-input100"></span>
    </div>

    <div class="container-login100-form-btn m-t-17">
        <button class="login100-form-btn">
            Register
        </button>
    </div>

    <div class="w-full text-center p-t-55">
        <span class="txt2">
            Already member?
        </span>

        <a href="{{route('login')}}" class="txt2 bo1">
            Login
        </a>
    </div>
</form>
@endsection
@extends('auth.layout')
@section('title', 'Login')
@section('content')
<form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('login') }}">
    @csrf

    <div class="w-full">
        <span class="login100-form-title">
            Login
        </span>
        <div class="p-t-31 p-b-9">
            <span class="txt1">
                Email
            </span>
        </div>
        <div class="wrap-input100 validate-input">
            <input class="input100 @error('email') focus-error100 @enderror" type="email" name="email"
                placeholder="name@example.com" value="{{ old('email') }}" required>
            <span class="focus-input100"></span>
        </div>
        @error('email')
        <div class="error m-t-5">{{ $message }}</div>
        @enderror
    </div>


    <div class="w-full">
        <div class="p-t-13 p-b-9">
            <span class="txt1">
                Password
            </span>

            <a href="{{route('passwords.forget')}}" class="txt2 bo1 m-l-5">
                Forgot?
            </a>
        </div>
        <div class="wrap-input100 validate-input">
            <input class="input100 @error('password') focus-error100 @enderror" type="password" name="password"
                placeholder="********">
            <span class="focus-input100"></span>
        </div>
        @error('password')
        <div class="error m-t-5">{{ $message }}</div>
        @enderror
    </div>

    <div class="container-login100-form-btn m-t-17">
        <button class="login100-form-btn">
            Sign In
        </button>
    </div>

    <div class="w-full text-center p-t-55">
        <span class="txt2">
            Not a member?
        </span>

        <a href="{{route('register')}}" class="txt2 bo1">
            Sign up now
        </a>
    </div>

</form>

@endsection
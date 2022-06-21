@extends('auth.layout')
@section('title', 'Reset Password')
@section('content')
<form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('passwords.reset') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <span class="login100-form-title">
        {{ __('Reset Password') }}
    </span>

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <!-- email -->
    <div class="w-full">
        <div class="p-t-31 p-b-9">
            <span class="txt1">
                Email
            </span>
        </div>
        <div class="wrap-input100 validate-input">
            <input class="input100 @error('email') focus-error100 @enderror" type="email" name="email"
                placeholder="name@example.com" value="{{ $email ?? old('email') }}" required>
            <span class="focus-input100"></span>
        </div>
        @error('email')
        <div class="error m-t-5">{{ $message }}</div>
        @enderror
    </div>

    <!-- password -->
    <div class="w-full">
        <div class="p-t-13 p-b-9">
            <span class="txt1">
                Password
            </span>
        </div>
        <div class="wrap-input100 validate-input">
            <input class="input100 @error('password') focus-error100 @enderror" type="password" name="password"
                placeholder="********" required>
            <span class="focus-input100"></span>
        </div>
        @error('password')
        <div class="error m-t-5">{{$message}}</div>
        @enderror
    </div>

    <!-- confirm password -->
    <div class="w-full">
        <div class="p-t-13 p-b-9">
            <span class="txt1">
                Confirm Password
            </span>
        </div>
        <div class="wrap-input100 validate-input">
            <input class="input100" type="password" name="password_confirmation" placeholder="********" required>
            <span class="focus-input100"></span>
        </div>
    </div>

    <div class="container-login100-form-btn m-t-17">
        <button class="login100-form-btn">
            Reset Password
        </button>
    </div>

    <div class="w-full text-center p-t-55">
        <span class="txt2">
            Already member?
        </span>

        <a href="#" class="txt2 bo1">
            Login
        </a>
    </div>
</form>
@endsection
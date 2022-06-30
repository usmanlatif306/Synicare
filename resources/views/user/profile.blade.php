@extends('layouts.account')
@section('title', 'Profile')
@section('content')
<div class="container page-container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Profile Image</h4>
                </div>
                <div class="card-body">
                    @if (session('image'))
                    <div class="alert alert-success" role="alert">
                        {{ session('image') }}
                    </div>
                    @endif
                    <img src="{{auth()->user()->image ? url('/').'/'.auth()->user()->image:asset('storage/images/user.jpg')}}" alt="User Image" class="img-fluid">
                    <form class="mt-3" action="{{route('profile.image')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" class="form-control" name="image">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-synicare">Update Profile Image</button>

                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>User Information</h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form action="{{route('profile.update')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{auth()->user()->name ?? old('name')}}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth</label>
                            <input id="date_of_birth" type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" placeholder="Blood Group" value="{{auth()->user()->date_of_birth ? auth()->user()->date_of_birth->format('Y-m-d') : old('date_of_birth')}}">
                            @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input id="phone" type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone" value="{{auth()->user()->phone ?? old('phone')}}">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input id="address" type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Name" value="{{auth()->user()->address ?? old('address')}}">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type=" submit" class="btn btn-synicare">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Update Password</h4>
                </div>
                <div class="card-body">
                    @if (session('password'))
                    <div class="alert alert-success" role="alert">
                        {{ session('password') }}
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form action="{{route('profile.password')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="old_password">Old Password</label>
                            <input id="old_password" type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" placeholder="Old Password">
                            @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                        </div>
                        <button type=" submit" class="btn btn-synicare">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.account')
@section('title', 'Profile')
@section('content')
<div class="container page-container">
    <div class="row">
        <div></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Profile Image
                </div>
                <div class="card-body">
                    @if (session('image'))
                    <div class="alert alert-success" role="alert">
                        {{ session('image') }}
                    </div>
                    @endif
                    <img src="{{$user->image ? url('/').'/'.$user->image:asset('storage/images/user.jpg')}}"
                        alt="User Image" class="img-fluid">
                    <form class="mt-3" action="{{route('admin.users.image',$user->id)}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" class="form-control" name="image">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile Image</button>

                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">User Information</div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form action="{{route('admin.users.update',$user->id)}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="name" type="email" name="email" class="form-control" value="{{$user->email}}"
                                readonly>

                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Name"
                                value="{{$user->name ?? old('name')}}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input id="phone" type="text" name="phone"
                                class="form-control @error('Phone') is-invalid @enderror" placeholder="Phone"
                                value="{{$user->phone ?? old('phone')}}">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth</label>
                            <input id="date_of_birth" type="date" name="date_of_birth"
                                class="form-control @error('date_of_birth') is-invalid @enderror"
                                placeholder="Blood Group"
                                value="{{$user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : old('date_of_birth')}}">
                            @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input id="address" type="text" name="address"
                                class="form-control @error('address') is-invalid @enderror" placeholder="Address"
                                value="{{$user->address ?? old('address')}}">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                            <small class="text-primary">Only enter password if you want to update</small>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input id="confirm_password" type="password" name="password_confirmation"
                                class="form-control " placeholder="Confirm Password">
                        </div>
                        <button type=" submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
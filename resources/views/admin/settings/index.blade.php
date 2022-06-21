@extends('layouts.account')
@section('title', 'Settings')
@section('content')
<div class="container page-container">
    <div class="row">
        <div></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>General Setting</h4>
                </div>
                <div class="card-body">
                    @if (session('general'))
                    <div class="alert alert-success" role="alert">
                        {{ session('general') }}
                    </div>
                    @endif
                    <form class="mt-3" action="{{route('admin.settings.general')}}" method="POST">
                        @csrf
                        @foreach($data['generals'] as $key=>$value)
                        <div class="form-group">
                            <label for="{{$key}}" class="text-capitalize">{{str_replace('_',' ',$key)}}</label>
                            <input id="{{$key}}" type="text" class="form-control" name="{{$key}}" value="{{$value}}">
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    <hr />
                    <!-- test email -->
                    @if (session('email'))
                    <div class="alert alert-success" role="alert">
                        {{ session('email') }}
                    </div>
                    @endif
                    <form class="mt-3" action="{{route('admin.settings.email')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="text-capitalize">Test Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email Address">
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Email Configuration</h4>
                </div>
                <div class="card-body">
                    <form class="mt-3" action="{{route('admin.settings.general')}}" method="POST">
                        @csrf
                        @foreach($data['email'] as $key=>$value)
                        <div class="form-group">
                            <label for="{{$key}}" class="text-capitalize">{{str_replace('_',' ',$key)}}</label>
                            <input id="{{$key}}" type="text" class="form-control" name="{{$key}}" value="{{$value}}">
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
@extends('layouts.account')
@section('title', 'Create Plan')
@section('content')
<div class="container page-container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Create New Plan</h4>
            <a class="btn btn-sm btn-primary" href="{{route('admin.plans.index')}}">Back</a>
        </div>
        <div class="card-body">
            <form action="{{route('admin.plans.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Plan Name" value="{{old('name')}}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input id="price" type="text" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Plan Price" value="{{old('price')}}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button type=" submit" class="btn btn-primary">Create Plan</button>
            </form>
        </div>
    </div>
</div>
@endsection
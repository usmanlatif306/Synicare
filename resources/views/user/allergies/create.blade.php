@extends('layouts.account')
@section('title', 'Create New Allergy')
@section('content')
<div class="container page-container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Create New Allergy</h4>
            <a class="btn btn-sm btn-synicare" href="{{route('user.allergies.index')}}">Back</a>
        </div>
        <div class="card-body">
            <form action="{{route('user.allergies.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="allergies">Allergies</label>
                    <input id="allergies" type="text" name="allergies" class="form-control @error('allergies') is-invalid @enderror" placeholder="Allergies" value="{{old('allergies')}}">
                    <small class="text-primary">use ' , ' for multiple allergies</small>
                    @error('allergies')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type=" submit" class="btn btn-synicare">Create Allergy</button>
            </form>
        </div>
    </div>
</div>
@endsection
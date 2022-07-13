@extends('layouts.account')
@section('title', 'Edit Medication')
@section('content')
<div class="container page-container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Edit Medication</h4>
            <a class="btn btn-sm btn-synicare" href="{{route('user.medications.index')}}">Back</a>
        </div>
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <form action="{{route('user.medications.update',$medication->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="medication">Medication</label>
                    <input id="medication" type="text" name="medication" class="form-control @error('medication') is-invalid @enderror" placeholder="Medication" value="{{$medication->medication}}">
                    @error('medication')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="doze">Dose</label>
                    <input id="doze" type="text" name="doze" class="form-control @error('doze') is-invalid @enderror" placeholder="Dose" value="{{$medication->doze}}">
                    @error('dose')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="frequency">Frequency</label>
                    <input id="frequency" type="text" name="frequency" class="form-control @error('frequency') is-invalid @enderror" placeholder="Frequency" value="{{$medication->frequency}}">
                    @error('frequency')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="prescriber">Prescriber</label>
                    <input id="prescriber" type="text" name="prescriber" class="form-control @error('prescriber') is-invalid @enderror" placeholder="Prescriber" value="{{$medication->prescriber}}">
                    @error('prescriber')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="prescriber">Medication Image</label>
                    <input id="prescriber" type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    <small>Only jpeg,png,jpg,gif are allowed. Max size: 5MB</small>
                    <small class="d-block">Don't Update if you want old image</small>
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                @if($medication->image)
                <div class="w-25 mx-auto">
                    <img src="{{url('/').'/'.$medication->image}}" alt="Medication Image" class="img-fluid rounded">
                </div>
                @endif
                <button type=" submit" class="btn btn-synicare">Update Medication</button>
            </form>
        </div>
    </div>
</div>
@endsection
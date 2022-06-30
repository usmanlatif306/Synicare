@extends('layouts.account')
@section('title', 'Create Medication')
@section('content')
<div class="container page-container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Create New Medication</h4>
            <a class="btn btn-sm btn-synicare" href="{{route('user.medications.index')}}">Back</a>
        </div>
        <div class="card-body">
            <form action="{{route('user.medications.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="medication">Medication</label>
                    <input id="medication" type="text" name="medication" class="form-control @error('medication') is-invalid @enderror" placeholder="Medication" value="{{old('medication')}}">
                    @error('medication')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="doze">Doze</label>
                    <input id="doze" type="text" name="doze" class="form-control @error('doze') is-invalid @enderror" placeholder="Doze" value="{{old('doze')}}">
                    @error('doze')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="frequency">Frequency</label>
                    <input id="frequency" type="text" name="frequency" class="form-control @error('frequency') is-invalid @enderror" placeholder="Frequency" value="{{old('frequency')}}">
                    @error('frequency')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="prescriber">Prescriber</label>
                    <input id="prescriber" type="text" name="prescriber" class="form-control @error('prescriber') is-invalid @enderror" placeholder="Prescriber" value="{{old('prescriber')}}">
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
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type=" submit" class="btn btn-synicare">Create Medication</button>
            </form>
        </div>
    </div>
</div>
@endsection
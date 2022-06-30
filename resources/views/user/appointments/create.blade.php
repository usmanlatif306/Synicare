@extends('layouts.account')
@section('title', 'Create Appointment')
@section('content')
<div class="container page-container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Create New Appointment</h4>
            <a class="btn btn-sm btn-synicare" href="{{route('user.appointments.index')}}">Back</a>
        </div>
        <div class="card-body">
            <form action="{{route('user.appointments.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="consultant">Consultant</label>
                    <input id="consultant" type="text" name="consultant" class="form-control @error('consultant') is-invalid @enderror" placeholder="Consultant" value="{{old('consultant')}}">
                    @error('consultant')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="details">Appointment Note</label>
                    <textarea name="details" id="details" class="form-control @error('details') is-invalid @enderror" placeholder="Appointment Note">{{old('details')}}</textarea>
                    @error('details')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="due">Appointment Date</label>
                    <input id="due" type="datetime-local" name="due" class="form-control @error('due') is-invalid @enderror" value="{{old('due')}}">
                    @error('due')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type=" submit" class="btn btn-synicare">Create Appointment</button>
            </form>
        </div>
    </div>
</div>
@endsection
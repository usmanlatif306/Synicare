@extends('layouts.account')
@section('title', 'Edit Appointment')
@section('content')
<div class="container page-container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Edit Appointment</h4>
            <a class="btn btn-sm btn-synicare" href="{{route('user.appointments.index')}}">Back</a>
        </div>
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <form action="{{route('user.appointments.update',$appointment->id)}}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="consultant">Consultant</label>
                    <input id="consultant" type="text" name="consultant" class="form-control @error('consultant') is-invalid @enderror" placeholder="Consultant" value="{{$appointment->consultant}}">
                    @error('consultant')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="details">Appointment Note</label>
                    <textarea name="details" id="details" class="form-control @error('details') is-invalid @enderror" placeholder="Appointment Note">{{$appointment->details}}</textarea>
                    @error('details')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="due">Appointment Date</label>
                    <input id="due" type="datetime-local" name="due" class="form-control @error('due') is-invalid @enderror" value="{{$appointment->due->format('Y-m-d\TH:i')}}">
                    @error('due')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type=" submit" class="btn btn-synicare">Update Appointment</button>
            </form>
        </div>
    </div>
</div>
@endsection
@extends('layouts.account')
@section('title', 'Appointment')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Appointment</h4>
            <a class="btn btn-sm btn-primary" href="{{route('admin.appointments.create')}}">Add New</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    @livewire('user-appointment')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
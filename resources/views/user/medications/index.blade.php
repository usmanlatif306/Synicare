@extends('layouts.account')
@section('title', 'Medications')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Medications</h4>
            <a class="btn btn-sm btn-primary" href="{{route('user.medications.create')}}">Add New</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    @if($subscription && $subscription->expired_at->subDays(8)->lessThan(now()))
                    <div class="alert alert-danger">
                        Your subscription will expired after {{$subscription->expired_at->diffInDays(now())}} days.
                        kindly <a class="text-danger" href="{{route('subscription')}}">recharge</a> it.
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    @livewire('user-medication')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
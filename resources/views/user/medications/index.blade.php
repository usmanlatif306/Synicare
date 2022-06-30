@extends('layouts.account')
@section('title', 'Medications')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Medications</h4>
            <div class="">
                @if(auth()->user()->allergy)
                <a class="btn btn-sm btn-synicare mr-3" href="{{route('user.medications.create')}}">Add Medicatons</a>
                @else
                <a class="btn btn-sm btn-synicare" href="{{route('user.allergies.create')}}">Add Allergy</a>
                @endif
            </div>
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
                    @if(auth()->user()->allergy)
                    <div class="row">
                        <div class="col-12 mt-3 text-center">
                            <h4 class="text-center">Allergies: </h4>
                            <p style="font-size: 16px;">
                                {{ auth()->user()->allergy->allergies}}
                                <a title="Edit Allergy" class="ml-1 text-primary" style="font-size: 12px;" href="{{route('user.allergies.edit',auth()->user()->allergy->id)}}">
                                    <i class="fas fa-edit"></i>

                                </a>
                            </p>
                        </div>
                        <div class=" col-12">
                            <h4 class="text-center">My Home Medications List</h4>
                        </div>
                    </div>
                    @livewire('user-medication')
                    @else
                    <div class="row">
                        <div class="col-12">
                            <h4 class="text-center">Kindly create allergy first</h4>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
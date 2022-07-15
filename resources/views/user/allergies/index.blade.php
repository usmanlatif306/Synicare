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

                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-12 mt-3 text-center">
                            <h4 class="text-center">Allergies: </h4>
                            <p>{{auth()->user()->allergy->allergies}}</p>
                        </div>
                        <div class="col-12">
                            <h4 class="text-center">My Home Medications List</h4>
                        </div>
                    </div>
                    @livewire('user-medication')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
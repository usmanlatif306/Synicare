@extends('layouts.account')
@section('title', 'Subscriptions')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Subscriptions</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    @livewire('user-subscription')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
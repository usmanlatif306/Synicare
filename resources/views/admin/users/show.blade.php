@extends('layouts.account')
@section('title', 'View Profile')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>User Details</h4>
                    <a class="btn btn-sm btn-primary" href="{{route('admin.users.index')}}">Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <th>Phone No</th>
                                    <td>{{$user->phone}}</td>
                                </tr>
                                <tr>
                                    <th>Date of Birth</th>
                                    <td>{{$user->date_of_birth ? $user->date_of_birth->format('d-m-Y') : ''}}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{$user->address}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- user medications -->
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>User Medications</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-synicare">
                                <tr>
                                    <th scope="col">Medication</th>
                                    <th scope="col">Doze</th>
                                    <th scope="col">Frequency</th>
                                    <th scope="col">Prescriber</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($user->allergy)
                                @forelse($user->allergy->medications as $item)
                                <tr>
                                    <td>{{$item->medication}}</td>
                                    <td>{{$item->doze}}</td>
                                    <td>{{$item->frequency}}</td>
                                    <td>{{$item->prescriber}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">No Data</td>
                                </tr>
                                @endforelse
                                @else
                                <tr>
                                    <td colspan="4">No Data</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- user subscriptions -->
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>User Subscriptions</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-synicare">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Payment Id</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Expired Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($user->subscriptions as $item)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$item->stripe_id}}</td>
                                    <td>${{$item->amount}}</td>
                                    <td>{{$item->expired_at->format('d-m-y H:i:s')}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">No Data</td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
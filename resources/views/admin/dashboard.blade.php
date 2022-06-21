@extends('layouts.account')
@section('title', 'Dashboard')
@section('content')
<div class="container page-container">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome {{auth()->user()->name}}</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- statistics -->
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="row">
                <div class="col-md-3 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-4">Number Of Patients</p>
                            <p class="fs-30 mb-2">{{$data['total_users']}}</p>
                            <p>{{$data['30days_user_percentage']}}% (30 days)</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <p class="mb-4">Today's Patients</p>
                            <p class="fs-30 mb-2">{{$data['today_users']}}</p>
                            <p>{{$data['today_users_percentage']}}% (30 days)</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4 mb-lg-0 transparent">
                    <div class="card card-light-blue">
                        <div class="card-body">
                            <p class="mb-4">Number of Medications</p>
                            <p class="fs-30 mb-2">{{$data['total_medications']}}</p>
                            <p>{{$data['30_days_medications_percentage']}}% (30 days)</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 transparent">
                    <div class="card card-light-danger">
                        <div class="card-body">
                            <p class="mb-4">Today's Medications</p>
                            <p class="fs-30 mb-2">{{$data['today_medications']}}</p>
                            <p>{{$data['today_medications_percentage']}}% (30 days)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- top five users -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Top 5 Users</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Date of Birth</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data['users'] as $user)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->date_of_birth ? $user->date_of_birth->format('d-m-Y') : ''}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">No User</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            <a href="{{route('admin.users.index')}}" class="btn btn-link text-primary font-md">See
                                All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- top five medication -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Top 5 Medications</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Medication</th>
                                    <th scope="col">Doze</th>
                                    <th scope="col">Frequency</th>
                                    <th scope="col">Prescriber</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data['medications'] as $item)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$item->medication}}</td>
                                    <td>{{$item->doze}}</td>
                                    <td>{{$item->frequency}}</td>
                                    <td>{{$item->prescriber}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">No Data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            <a href="{{route('admin.medications.index')}}" class="btn btn-link text-primary font-md">See
                                All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
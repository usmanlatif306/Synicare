@extends('layouts.account')
@section('title', 'Appointments')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>{{$user->name}} Appointments</h4>
            <a class="btn btn-sm btn-primary" href="{{route('admin.appointments.index')}}">Back</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Consultant</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Due</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($appointments as $item)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$item->user->phone}}</td>
                                    <td>{{$item->consultant}}</td>
                                    <td>{{$item->details}}</td>
                                    <td>{{$item->due}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ auth()->user()->role_id == 1 ? route('admin.appointments.edit',$item->id) : route('user.appointments.edit',$item->id)}}" class="text-primary cursor-pointer font-m mr-3" title="Edit Appointment"><i class=" fas fa-edit"></i></a>
                                            <form id="deleteAppointment-{{$item->id}}" action="{{ auth()->user()->role_id == 1 ? route('admin.appointments.destroy',$item->id): route('user.appointments.destroy',$item->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <span class="text-danger cursor-pointer font-m" onclick="if (confirm('Are you Sure?') == true) {
                                document.getElementById('deleteAppointment-{{$item->id}}').submit();
                              }" title="Delete Appointment"><i class="fas fa-trash"></i></span>
                                            </form>
                                        </div>


                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="{{auth()->user()->role_id == 1 ? 5 : 4}}">No Data</td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <div class="mt-3">{{$appointments->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('layouts.account')
@section('title', 'Subscriptions')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Subscriptions</h4>
            <a class="btn btn-sm btn-primary" href="{{route('admin.subscription')}}">Back</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-synicare">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Total</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($invoices as $item)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>

                                    <td>{{ $item->date()->toFormattedDateString() }}</td>
                                    <td>{{ $item->total() }}</td>
                                    <td>
                                        <a href="{{route('admin.user.subscription.download',[$user->id,$item->id])}}" class="btn btn-sm btn-primary">Download</a>
                                    </td>
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
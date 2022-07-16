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
                    @if($subscription)
                    @if(!request()->user()->subscription($plan->stripe_name)->onGracePeriod())
                    <div class="alert alert-success" role="alert">
                        Your subscription Is Active. <a href="{{route('user.subscription.cancel')}}" class="text-primary"> Cancel Subscription</a>
                    </div>
                    @else
                    <div class="alert alert-success" role="alert">
                        Your subsription will end on {{request()->user()->subscription($plan->stripe_name)->ends_at->format('m/d/Y')}}. <a href="{{route('user.subscription.resume')}}" class="text-primary"> Resume Subscription</a>
                    </div>
                    @endif
                    @endif
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
                                        <a href="{{route('user.invoice.download',$item->id)}}" class="btn btn-sm btn-primary">Download Invoice</a>
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
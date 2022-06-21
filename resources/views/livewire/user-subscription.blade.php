<div class="table-responsive">
    <table class="table table-striped table-primary">
        <thead>
            <tr>
                <th scope="col">No</th>
                @if(auth()->user()->role_id == 1)
                <th scope="col">User</th>
                @endif
                <th scope="col">Payment Id</th>
                <th scope="col">Amount</th>
                <th scope="col">Expired Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subscriptions as $item)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                @if(auth()->user()->role_id == 1)
                <td>{{$item->user->name}}</td>
                @endif
                <td>{{$item->stripe_id}}</td>
                <td>${{$item->amount}}</td>
                <td>{{$item->expired_at->format('d-m-y H:i:s')}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="{{auth()->user()->role_id == 1 ? 5 : 4}}">No Data</td>
            </tr>
            @endforelse

        </tbody>
    </table>
    <div class="mt-3">{{$subscriptions->links()}}</div>
</div>
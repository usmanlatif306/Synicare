<div>
    <div class="row mb-3">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <input type="text" class="form-control" wire:model="searchTerm" placeholder="Search Users">
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-synicare">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($subscriptions as $item)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>

                    <td>{{$item->name()}}</td>
                    <td>{{$item->email}}</td>
                    <td>
                        <a class="text-primary cursor-pointer font-m mr-3 decoration-none" href="{{ route('admin.user.subscriptions',$item->id) }}" title="View Subscriptions">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No Data</td>
                </tr>
                @endforelse

            </tbody>
        </table>
        <div class="mt-3">{{$subscriptions->links()}}</div>
    </div>
</div>
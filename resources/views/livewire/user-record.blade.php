<div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <input type="text" class="form-control" wire:model="searchTerm" placeholder="Search Users">
        </div>
    </div>
    <div class="table-responsive mt-3">
        <table class="table">
            <thead class="thead-synicare">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$user->name()}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>
                        <div class="d-flex">
                            <a class="text-primary cursor-pointer font-m mr-3 decoration-none" href="{{ route('admin.users.show',$user->id) }}" title="View User">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.users.edit',$user->id) }}" class="text-primary cursor-pointer font-m mr-3" title="Edit User"><i class=" fas fa-edit"></i></a>
                            <form id="deleteUser-{{$user->id}}" action="{{ route('admin.users.destroy',$user->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <span class="text-danger cursor-pointer font-m" onclick="if (confirm('Are you Sure') == true) {
                            document.getElementById('deleteUser-{{$user->id}}').submit();
                          }" title="Delete User"><i class="fas fa-trash"></i></span>
                            </form>
                        </div>


                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5">No User</td>
                </tr>
                @endforelse

            </tbody>
        </table>
        <div class="mt-3">{{$users->links()}}</div>
    </div>
</div>
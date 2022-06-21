<div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <input type="text" class="form-control" wire:model="searchTerm" placeholder="Search Appointments">
        </div>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-primary">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    @if(auth()->user()->role_id == 1)
                    <th scope="col">User</th>
                    <th scope="col">Phone</th>
                    @endif
                    <th scope="col">Consultant</th>
                    <th scope="col">Due</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $item)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    @if(auth()->user()->role_id == 1)
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->user->phone}}</td>
                    @endif
                    <td>{{$item->consultant}}</td>
                    <td>{{$item->due}}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ auth()->user()->role_id == 1 ? route('admin.appointments.edit',$item->id) : route('user.appointments.edit',$item->id)}}"
                                class="text-primary cursor-pointer font-m mr-3" title="Edit Appointment"><i
                                    class=" fas fa-edit"></i></a>
                            <form id="deleteAppointment-{{$item->id}}"
                                action="{{ auth()->user()->role_id == 1 ? route('admin.appointments.destroy',$item->id): route('user.appointments.destroy',$item->id) }}"
                                method="POST">
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
                    <td colspan="{{auth()->user()->role_id == 1 ? 6 : 4}}">No Data</td>
                </tr>
                @endforelse

            </tbody>
        </table>
        <div class="mt-3">{{$appointments->links()}}</div>
    </div>
</div>
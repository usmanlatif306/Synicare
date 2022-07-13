<div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <input type="text" class="form-control" wire:model="searchTerm" placeholder="Search Appointments">
        </div>
    </div>
    <div class="table-responsive mt-3">
        <table class="table">
            <thead class="thead-synicare">
                <tr>
                    @if(auth()->user()->role_id == 1)
                    <th scope="col">User</th>
                    <th scope="col">Latest Appointment Date</th>
                    @else
                    <th scope="col">Specialist</th>
                    <th scope="col">Date</th>
                    @endif
                    @if(auth()->user()->role_id == 1)
                    <th scope="col">View Appointment</th>
                    @else
                    <th scope="col"></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $item)
                <tr>
                    @if(auth()->user()->role_id == 1)
                    <td>{{$item->name()}}</td>
                    <td>{{$item->appointments()->select(['due'])->first()->due}}</td>
                    @else
                    <td>{{$item->consultant}}</td>
                    <td>{{$item->due->format('m/d/Y')}}</td>
                    @endif
                    <td>
                        <div class="d-flex justify-content-center">
                            @if(auth()->user()->role_id == 1)
                            <a href="{{ route('admin.appointments.show',$item->id)}}">
                                <span class="text-primary cursor-pointer font-m mr-3" title="View Appointment"><i class="fas fa-eye"></i></span>
                            </a>
                            @else
                            <a href="{{ auth()->user()->role_id == 1 ? route('admin.appointments.edit',$item->id) : route('user.appointments.edit',$item->id)}}" class="text-primary cursor-pointer font-m mr-3" title="Edit Appointment"><i class=" fas fa-edit"></i></a>
                            <form id="deleteAppointment-{{$item->id}}" action="{{ auth()->user()->role_id == 1 ? route('admin.appointments.destroy',$item->id): route('user.appointments.destroy',$item->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <span class="text-danger cursor-pointer font-m" onclick="if (confirm('Are you Sure?') == true) {
                                document.getElementById('deleteAppointment-{{$item->id}}').submit();
                              }" title="Delete Appointment"><i class="fas fa-trash"></i></span>
                            </form>
                            @endif
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
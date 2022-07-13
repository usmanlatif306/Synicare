<div class="mt-3">
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <input type="text" class="form-control" wire:model="searchTerm" placeholder="Search Medications">
        </div>
        <!-- <div class="col-12 mt-3 text-center">
            <h4 class="text-center">Allergies: </h4>
            <p>{{auth()->user()->allergy->allergies}}</p>
        </div>
        <div class="col-12">
            <h4 class="text-center">My Home Medications List</h4>
        </div> -->
    </div>
    <!-- allergies list -->
    <div class="table-responsive mt-3">
        <table class="table">
            <thead class="thead-synicare">
                <tr>
                    @if(auth()->user()->role_id == 1)
                    <th scope="col" style="width: 60%;">User</th>
                    @else
                    <th scope="col">Medication</th>
                    <th scope="col">Dose</th>
                    <th scope="col">Frequency</th>
                    <th scope="col">Prescriber</th>
                    @endif
                    <th>Last Updated</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($medications as $item)
                <tr>
                    @if(auth()->user()->role_id == 1)
                    <td scope="col" style="width: 60%;">{{$item->name()}}</th>
                        @else
                    <td>{{$item->medication}}</td>
                    <td>{{$item->doze}}</td>
                    <td>{{$item->frequency}}</td>
                    <td>{{$item->prescriber}}</td>
                    @endif
                    <td>{{$item->updated_at->format('m/d/Y g:i A')}}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ auth()->user()->role_id == 1 ? route('admin.medications.show',$item->id) : route('user.medications.show',$item->id)}}">
                                <span class="text-primary cursor-pointer font-m mr-3" title="View Medication"><i class="fas fa-eye"></i></span>
                            </a>

                            @if(auth()->user()->role_id != 1)
                            <a href="{{ auth()->user()->role_id == 1 ? route('admin.medications.edit',$item->id) : route('user.medications.edit',$item->id)}}" class="text-primary cursor-pointer font-m mr-3" title="Edit Medication"><i class=" fas fa-edit"></i></a>

                            <form id="deleteMedication-{{$item->id}}" action="{{ auth()->user()->role_id == 1 ? route('admin.medications.destroy',$item->id): route('user.medications.destroy',$item->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <span class="text-danger cursor-pointer font-m" onclick="if (confirm('Are you Sure?') == true) {
                                            document.getElementById('deleteMedication-{{$item->id}}').submit();
                                          }" title="Delete Medication"><i class="fas fa-trash"></i></span>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{auth()->user()->role_id == 1 ? 7 : 6}}">No Data</td>
                </tr>
                @endforelse

            </tbody>
        </table>
        <div class="mt-3">{{$medications->links()}}</div>
    </div>

</div>
<div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <input type="text" class="form-control" wire:model="searchTerm" placeholder="Search Medication">
        </div>
    </div>
    <!-- allergies list -->
    <div class="table-responsive mt-3">
        <table class="table table-striped table-primary">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col" style="width: 50%;">Allergies</th>
                    @if(auth()->user()->role_id == 1)
                    <th scope="col">Creater</th>
                    @endif
                    <th scope="col">Last Updated</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($allergies as $item)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td style="width: 50%;">{{$item->allergies}}</td>
                    @if(auth()->user()->role_id == 1)
                    <td>{{$item->user->name}}</td>
                    @endif
                    <td>{{$item->updated_at->format('d-m-Y H:i:s')}}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ auth()->user()->role_id == 1 ? route('admin.allergies.show',$item->id) : route('user.allergies.show',$item->id)}}">
                                <span class="text-primary cursor-pointer font-m mr-3" title="View Allergy"><i class="fas fa-eye"></i></span>
                            </a>

                            <a href="{{ auth()->user()->role_id == 1 ? route('admin.allergies.edit',$item->id) : route('user.allergies.edit',$item->id)}}">
                                <span class="text-primary cursor-pointer font-m mr-3" title="Edit Allergy"><i class="fas fa-edit"></i></span>
                            </a>
                            <form id="deleteAllergy-{{$item->id}}" action="{{ auth()->user()->role_id == 1 ? route('admin.allergies.destroy',$item->id) : route('user.allergies.destroy',$item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <span class="text-danger cursor-pointer font-m" onclick="if (confirm('Are you Sure?') == true){
                                                 document.getElementById('deleteAllergy-{{$item->id}}').submit();
                                                    }" title="Delete Allergy"><i class="fas fa-trash"></i></span>
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
        <div class="mt-3">{{$allergies->links()}}</div>
    </div>
    <!-- <div class="table-responsive mt-3">
        <table class="table table-striped table-primary">
            <thead>
                <tr>
                    <th scope="col">Medication</th>
                    <th scope="col">Doze</th>
                    <th scope="col">Frequency</th>
                    <th scope="col">Prescriber</th>
                    <th scope="col">Lat Updated</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($medications as $item)
                <tr>
                    <td>{{$item->medication}}</td>
                    <td>{{$item->doze}}</td>
                    <td>{{$item->frequency}}</td>
                    <td>{{$item->prescriber}}</td>
                    <td>{{$item->updated_at->format('d-m-Y H:i:s')}}</td>
                    <td>
                        <a
                            href="{{ auth()->user()->role_id == 1 ? route('admin.medications.show',$item->id) : route('user.medications.show',$item->id)}}">
                            <span class="text-primary cursor-pointer font-m mr-3" title="View Medication"><i
                                    class="fas fa-eye"></i></span>
                        </a>

                        <a href="{{ auth()->user()->role_id == 1 ? route('admin.medications.edit',$item->id) : route('user.medications.edit',$item->id)}}"
                            class="text-primary cursor-pointer font-m mr-3" title="Edit Medication"><i
                                class=" fas fa-edit"></i></a>
                        <span class="text-danger cursor-pointer font-m" onclick="if (confirm('Are you Sure?') == true) {
                            document.getElementById('deleteMedication-{{$item->id}}').submit();
                          }" title="Delete Medication"><i class="fas fa-trash"></i></span>
                    </td>
                    <form id="deleteMedication-{{$item->id}}"
                        action="{{ auth()->user()->role_id == 1 ? route('admin.medications.destroy',$item->id): route('user.medications.destroy',$item->id) }}"
                        method="POST">
                        @csrf
                        @method('delete')
                    </form>
                </tr>
                @empty
                <tr>
                    <td colspan="{{auth()->user()->role_id == 1 ? 8 : 7}}">No Data</td>
                </tr>
                @endforelse

            </tbody>
        </table>
        <div class="mt-3">{{$medications->links()}}</div>
    </div> -->
</div>
@extends('layouts.account')
@section('title', 'Medications')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>{{$allergy->user->name()}}'s Medication Details</h4>
        <div class="">
            @if(!auth()->user()->allergy)
            <a class="btn btn-sm btn-primary mr-3" href="{{route('admin.allergies.create')}}">Add Allergy</a>
            @else
            <a class="btn btn-sm btn-primary mr-3" href="{{route('admin.medications.create')}}">Add New Medication</a>
            @endif
            <a class="btn btn-sm btn-primary" href="{{route('admin.medications.index')}}">Back</a>
        </div>

    </div>
    <div class="card-body">
        <div class="mt-3">
            <div class="row">
                <div class="col-12 mt-3 text-center">
                    <h4 class="text-center">Allergies: </h4>
                    <p style="font-size: 16px;">
                        {{ $allergy->allergies}}
                        <a title="Edit Allergy" class="ml-1 text-primary" style="font-size: 12px;" href="{{route('admin.allergies.edit',$allergy->id)}}">
                            <i class="fas fa-edit"></i>

                        </a>
                    </p>
                </div>
                <!-- <div class="col-12">
            <h4 class="text-center">My Home Medications List</h4>
        </div> -->
            </div>
            <!-- allergies list -->
            <div class="table-responsive mt-3">
                <table class="table table-striped table-primary">
                    <thead>
                        <tr>
                            <th scope="col">Medication</th>
                            <th scope="col">Doze</th>
                            <th scope="col">Frequency</th>
                            <th scope="col">Prescriber</th>
                            <th>Last Updated</th>
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
                                <div class="d-flex">
                                    <a href="{{ auth()->user()->role_id == 1 ? route('admin.medications.view',$item->id) : route('user.medications.show',$item->id)}}">
                                        <span class="text-primary cursor-pointer font-m mr-3" title="View Medication"><i class="fas fa-eye"></i></span>
                                    </a>

                                    <a href="{{ auth()->user()->role_id == 1 ? route('admin.medications.edit',$item->id) : route('user.medications.edit',$item->id)}}" class="text-primary cursor-pointer font-m mr-3" title="Edit Medication"><i class=" fas fa-edit"></i></a>
                                    <form id="deleteMedication-{{$item->id}}" action="{{ auth()->user()->role_id == 1 ? route('admin.medications.destroy',$item->id): route('user.medications.destroy',$item->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <span class="text-danger cursor-pointer font-m" onclick="if (confirm('Are you Sure?') == true) {
                                            document.getElementById('deleteMedication-{{$item->id}}').submit();
                                          }" title="Delete Medication"><i class="fas fa-trash"></i></span>
                                    </form>

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
    </div>
</div>

@endsection
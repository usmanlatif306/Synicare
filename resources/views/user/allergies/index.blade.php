@extends('layouts.account')
@section('title', 'Medications')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Allergies</h4>
            <div class="">
                @if(auth()->user()->allergies()->count() > 0)
                <a class="btn btn-sm btn-primary mr-3" href="{{route('user.medications.create')}}">Add Medicatons</a>
                @endif
                <a class="btn btn-sm btn-primary" href="{{route('user.allergies.create')}}">Add Allergy</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    @if($subscription && $subscription->expired_at->subDays(8)->lessThan(now()))
                    <div class="alert alert-danger">
                        Your subscription will expired after {{$subscription->expired_at->diffInDays(now())}} days.
                        kindly <a class="text-danger" href="{{route('subscription')}}">recharge</a> it.
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    @livewire('user-medication')
                    <!-- allergies list -->
                    <!-- <div class="table-responsive mt-3">
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
                                            <a
                                                href="{{ auth()->user()->role_id == 1 ? route('admin.allergies.show',$item->id) : route('user.allergies.show',$item->id)}}">
                                                <span class="text-primary cursor-pointer font-m mr-3"
                                                    title="View Allergy"><i class="fas fa-eye"></i></span>
                                            </a>

                                            <a
                                                href="{{ auth()->user()->role_id == 1 ? route('admin.allergies.edit',$item->id) : route('user.allergies.edit',$item->id)}}">
                                                <span class="text-primary cursor-pointer font-m mr-3"
                                                    title="Edit Allergy"><i class="fas fa-edit"></i></span>
                                            </a>
                                            <form id="deleteAllergy-{{$item->id}}"
                                                action="{{ auth()->user()->role_id == 1 ? route('admin.allergies.destroy',$item->id) : route('user.allergies.destroy',$item->id) }}"
                                                method="post">
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
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
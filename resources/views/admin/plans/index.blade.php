@extends('layouts.account')
@section('title', 'Plans')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Plans</h4>
            <a class="btn btn-sm btn-primary" href="{{route('admin.plans.create')}}">Add New</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="table-responsive mt-3">
                        <table class="table">
                            <thead class="thead-synicare">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($plans as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>${{$item->price}}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <!-- <a href="{{route('admin.plans.edit',$item->slug)}}" class="text-primary cursor-pointer font-m mr-3" title="Edit Plan"><i class=" fas fa-edit"></i></a> -->
                                            <form id="deletePlan-{{$item->id}}" action="{{route('admin.plans.destroy',$item->slug)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <span class="text-danger cursor-pointer font-m" onclick="if (confirm('Are you Sure?') == true) {
                                document.getElementById('deletePlan-{{$item->id}}').submit();
                              }" title="Delete Plan"><i class="fas fa-trash"></i></span>
                                            </form>
                                        </div>
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
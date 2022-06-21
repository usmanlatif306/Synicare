@extends('layouts.account')
@section('title', $medication->medication)
@section('content')
<div class="table-responsive mt-3">
    <table class="table table-hover table-bordered">
        <thead class="">
            <th colspan="2">
                <div class="d-flex justify-content-between align-items-center">
                    <span style="font-size: 18px;">Medication Details</span>
                    <a href="{{route('admin.allergies.show',$medication->allergy->id)}}" class="btn btn-sm btn-primary">Back</a>
                </div>
            </th>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Medication</th>
                <td>{{$medication->medication}}</td>
            </tr>
            <tr>
                <th scope="row">Doze</th>
                <td>{{$medication->doze}}</td>
            </tr>
            <tr>
                <th scope="row">Frequency</th>
                <td>{{$medication->frequency}}</td>
            </tr>
            <tr>
                <th scope="row">Prescriber</th>
                <td>{{$medication->prescriber}}</td>
            </tr>
            @if($medication->image)
            <tr>
                <th scope="row" colspan="2">Image</th>
            </tr>
            <tr>
                <th scope="row" colspan="2">
                    <div class="w-50 mx-auto">
                        <img src="{{url('/').'/'.$medication->image}}" alt="Medication Image" class="img-fluid rounded">
                    </div>
                </th>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
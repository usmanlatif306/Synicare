@extends('layouts.account')
@section('title', 'Edit Allergy')
@section('content')
<div class="container page-container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Edit Allergy</h4>
            <a class="btn btn-sm btn-synicare" href="{{route('user.medications.index')}}">Back</a>
        </div>
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <form action="{{route('user.allergies.update',$allergy->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="allergies">Allergies</label>
                    <input id="allergies" type="text" name="allergies" class="form-control @error('allergies') is-invalid @enderror" placeholder="Allergies" value="{{$allergy->allergies}}">
                    <small class="text-primary">use ' , ' for multiple allergies</small>
                    @error('allergies')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button type=" submit" class="btn btn-synicare">Update Allergy</button>
            </form>
        </div>
    </div>
</div>
@endsection
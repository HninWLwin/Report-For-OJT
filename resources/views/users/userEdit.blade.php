@extends('layouts.app')

@section('content')
<div class="py-4 container">
    <div class="card">
        <div class="card-header">
            Profile Edit 
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Name*</label>
                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Email" class="col-sm-2 col-form-label">E-mail Address*</label>
                    <div class="col-sm-6">
                        <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="type" class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-6">
                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="type">
                            <option value="0" {{ $user->type == 0 ? 'selected' : ''}}>Admin</option>
                            <option value="1" {{ $user->type == 1 ? 'selected' : ''}}>User</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-6">
                        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                    <div class="col-sm-6">
                        <input type="date" name="dob" id="dob" class="form-control"  value="{{ $user->dob }}" autocomplete="off">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-6">
                        <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="profile" class="col-sm-2 col-form-label">Old Profile</label>
                    <div class="col-sm-6">
                    <img src="/storage/images/{{ Auth::user()->profile }}" alt="" 
                        style="width: 200px;height: 200px; padding: 10px; margin: 0px; "/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="profile" class="col-sm-2 col-form-label">New Profile</label>
                    <div class="col-sm-6">
                        <input type="file" name="profile" class="form-control-file" value="{{ $user->profile }}">
                    </div>
                </div>

                <input type="hidden" value="{{ $user->profile }}" name="profile" id="id">
                <input type="hidden" value="{{ $user->id }}" name ="id" id="id" >
                <div class="form-group row">
                    <div class="col-xs-6 col-sm-6 col-md-6 text-center">
                        <button type="submit" class="btn btn-primary">Edit</button>
                        <button type="reset" class="btn btn-secondary">Clear</button>
                        <a href="{{ route('change_password', $user->id) }}">Change Password</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection



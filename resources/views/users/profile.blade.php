@extends('layouts.app')

@section('content')
<div class="py-4 container">
    <div class="card">
        <div class="card-header">
            Profile 
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <img src="/storage/images/{{ Auth::user()->profile }}" alt="" 
                        style="width: 200px;height: 200px; padding: 10px; margin: 0px; "/>
                    </div>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {{ $user->name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Type:</strong>
                                {{ $user->type == 1 ? 'User' : 'Admin' }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Email:</strong>
                                {{ $user->email }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Phone:</strong>
                                {{ $user->phone }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Date of Birth:</strong>
                                {{ $user->dob }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Address:</strong>
                                {{ $user->address }}
                            </div>
                        </div>
                        <input type="hidden" value="{{ $user->id }}" name = "id" id="id" >
                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

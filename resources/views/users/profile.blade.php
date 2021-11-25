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

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

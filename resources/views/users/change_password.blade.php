@extends('layouts.app')

@section('content')
<div class="py-4 container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Change Password
                </div>
                <div class="card-body">
                    <form action="{{ route('update_password', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="staticEmail" class="col-md-4 col-form-label text-md-right">Current Password*</label>
                            <div class="col-md-6">
                                <input type="password" name="currentPassword" class="form-control @error('currentPassword') is-invalid @enderror">
                                
                                @if ($errors->has('currentPassword'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('currentPassword') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-md-4 col-form-label text-md-right">New Password*</label>
                            <div class="col-md-6">
                                <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror">
                                
                                @if ($errors->has('new_password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('new_password') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-md-4 col-form-label text-md-right">New Confirm Password*</label>
                            <div class="col-md-6">
                                <input type="password" name="newConfirmPassword" class="form-control @error('newConfirmPassword') is-invalid @enderror">
                                
                                @if ($errors->has('newConfirmPassword'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('newConfirmPassword') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
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

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
                            <label for="staticEmail" class="col-md-4 col-form-label text-md-right">Current Password</label>
                            <div class="col-md-6">
                                <input type="text" name="currentPassword" class="form-control @error('currentPassword') is-invalid @enderror">
                                
                                @if ($errors->has('currentPassword'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('currentPassword') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-md-4 col-form-label text-md-right">New Password</label>
                            <div class="col-md-6">
                                <input type="text" name="new_password" class="form-control @error('new_password') is-invalid @enderror">
                                
                                @if ($errors->has('new_password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('new_password') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>
                            <div class="col-md-6">
                                <input type="text" name="newConfirmPassword" class="form-control @error('newConfirmPassword') is-invalid @enderror">
                                
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
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register Confirm') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name*') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " name="name" value="{{ $user->name }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address*') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email" value="{{ $user->email}}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password*') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control " name="password" value="{{ $user->password }}" name="password" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Password Confirmation*') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"  value="{{ $user->password_confirmation }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type*') }}</label>

                            <div class="col-md-6">
                            <input id="type" type="text" class="form-control" name="type" value="{{ $user->type }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone*') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control" name="phone" value="{{ $user->phone  }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of birth*') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="text" class="form-control" name="dob" value="{{ $user->dob }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address*') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="address" class="form-control"  name="address" value="{{ $user->address }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile" class="col-md-4 col-form-label text-md-right">{{ __('Profile*') }}</label>

                            <div class="col-md-6">
                                <p>{{ $user->profile}} </p>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" >
                                    {{ __('Confirm') }} 
                                </button>
                                <a href="{{ url()->previous(), $user->id }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

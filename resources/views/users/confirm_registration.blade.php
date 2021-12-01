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
                                <input id="name" type="text" class="form-control " name="name" value="{{ $user->name }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address*') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email" value="{{ $user->email}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password*') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control " name="password" value="{{ $user->password }}" name="password" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Password Confirmation*') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password_confirmation" class="form-control"  value="{{ $user->password_confirmation }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type*') }}</label>

                            <div class="col-md-6">
                            <input id="type" type="text" class="form-control" name="type" value="{{ $user->type == 0 ? 'Admin' : 'User' }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control" name="phone" value="{{ $user->phone  }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of birth') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="text" class="form-control" name="dob" value="{{ $user->dob }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="address" class="form-control"  name="address" value="{{ $user->address }}" readonly >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile" class="col-md-4 col-form-label text-md-right">{{ __('Profile*') }}</label>

                            <div class="col-md-6">
                                <img src="/storage/images/{{ $user->profile }}" alt="" 
                            style="width: 200px;height: 200px; padding: 10px; margin: 0px; "/>
                            </div>
                        </div>

                        <input type="hidden" value="{{ $user->profile }}" name="profile" >
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" >
                                    {{ __('Confirm') }} 
                                </button>
                                <a onclick="window.history.back();" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">

    $(document).ready(function(){
        $('a.back').click(function(){
            parent.history.back();
            return false;
        });
    });

</script>


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Post') }}</div>
    
                <div class="card-body">
                    <form  method="POST" action="{{ route('post.register') }}" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="form-group row">    
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title*') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control " name="title" value="{{ $post->title }}"disabled >

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description*') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control " name="description" value="{{ $post->description }}" disabled>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success" >
                                    {{ __('Confirm') }} 
                            </button>
                            <a href="{{ url()->previous(), $post->id }}" class="btn btn-secondary">Cancel</a>
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

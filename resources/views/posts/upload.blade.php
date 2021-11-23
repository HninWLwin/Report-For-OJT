@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Upload CSV File') }}</div>
               

                <div class="card-body">
                    <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif -->

                        @if ($errors->has('title'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                    </div>
                                @endif

                        <div class="form-group row">
                            <label for="customFile" class="col-md-4 col-form-label text-md-right">{{ __('CSV file') }}</label>

                            <div class="col-md-6">
                            <input type="file" name="file" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button class="btn btn-primary">Upload</button>
                                <input type="reset" class="btn btn-secondary" value="Clear"/>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

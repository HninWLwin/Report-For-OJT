@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirm Post') }}</div>
              
                <div class="card-body">
                    <form  method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">    
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control " name="title" value="{{ $post->title }}"  placeholder="Title" readonly>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control " name="description" value="{{ $post->description }}" placeholder="Description" readonly>

                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="flexSwitchCheckChecked" class="col-md-4 col-form-label text-md-right form-check-label">Status</label>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="status" type="checkbox" readonly id="flexSwitchCheckChecked" value="{{ $post->status }}"  {{ ($post->status == 1 ? ' checked' : '') }} / >
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value="{{ $post->id }}" id="id" name="id">
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">update</button>
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


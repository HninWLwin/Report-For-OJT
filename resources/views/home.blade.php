@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Post List') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container-lg">
                        <div class="table-responsive">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="row">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <div class="form-group row">
                                                <label for="keyword" class="col-sm-2    col-form-label text-md-right">{{ __('keyword:') }}</label>    
                                                <div class="col-sm-4">
                                                    <input id="keyword" type="text" class="form-control " name="keyword" >
                                                </div>
                                                <input type="submit" class="btn btn-success "value="Search" action="{{ route('posts.index') }}">	&nbsp;	&nbsp;	&nbsp;
                                                <button type="submit" class="btn btn-success " ><a href="{{ route('posts.create') }}">{{ __('Create') }}</a></button>&nbsp; 	&nbsp; 	&nbsp;
                                                <button type="submit" class="btn btn-success ">{{ __('Upload') }}</button>	&nbsp;	&nbsp;	&nbsp;
                                                <button type="submit" class="btn btn-success ">{{ __('Download') }}</button>
                                            </div> 
                                         </div>         
                                    </div>
                                </div>

                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <p>{{ $message  }}</p>
                                    </div>
                                @endif

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Post Title</th>
                                            <th>Post Description</th>
                                            <th>Posted User</th>
                                            <th>Posted Date</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
                                        @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->description }}</td>
                                            <td> {{ Auth::user()->name }}</td>
                                            <td>{{ $post->created_at }}</td>
                                            <td>
                                                <button type="button" a class="btn btn-primary" title="Edit" data-toggle="tooltip">Edit</a></button>
                                                <button type="button" a class="btn btn-danger" title="Edit" data-toggle="tooltip">Delete</a></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                 
                                </table>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>     

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

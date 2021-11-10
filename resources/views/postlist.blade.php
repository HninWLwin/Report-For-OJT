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
                                                <button type="submit" class="btn btn-success "><a href="">{{ __('Search') }}</a></button>	&nbsp;	&nbsp;	&nbsp;
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
                                        @if (!empty($posts) && $posts->count())
                                            @foreach ($posts as $post)
                                            <tr>
                                                <td data-toggle="modal" id="myModal" data-target="#postdetails_modal" 
                                                
                                                >{{ $post->title }}</td>
                                                <td>{{ $post->description }}</td>
                                                <td> {{ Auth::user()->name }}</td>
                                                <td>{{ $post->created_at }}</td>
                                                <td>
                                                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-Success">Edit</a>

                                                        @method('DELETE')
                                                        @csrf   
                                                        <button type="submit" a class="btn btn-danger " data-toggle="tooltip" 
                                                        onclick="return deleteConfirm()" >Delete</a></button>
                                                    </form>
                                                </td> 
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5">There are no data.</td>
                                            </tr>   

                                            
                                        @endif

                                         <!-- Modal -->
                                        <div class="modal fade" id="postdetails_modal" tabindex="-1" role="dialog" aria-labelledby="postdetails_modalTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Post Details</h5>
                                              
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Title - {{ $post->title }} <br>
                                                Description - {{ $post->description }} <br>
                                                Status - {{ $post->status }} <br>
                                                Created Date - {{ $post->created_at }} <br>
                                                Created User - {{ Auth::user()->name }} <br>
                                                Updated Date - {{ $post->updated_at }} <br>
                                                Updated User - {{ Auth::user()->name  }} <br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>

                                    </tbody>
                                 
                                </table>
                                {!! $posts->links() !!}

                                <!-- <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </nav> -->
                            </div>
                        </div>
                    </div>     

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
  function deleteConfirm() {
      if(!confirm("Are you sure to delete post?"))
      event.preventDefault(); 
  }

//   $('#myModal').on('click', '#postdetails_modal', function () {
//       $tr = $(this).Closest('tr');
//     //   var post_id = $(this).data('id');
//     //   var 
//       document.getElementById('title').innerHTML = title;
//       document.getElementById('description').innerHTML = description;
//       document.getElementById('status').innerHTML = status;

//       $('.modal-title').html('Post Details');
//       $('#id').val(id);
//   });

 </script>

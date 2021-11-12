@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Post List') }}</div>

                <div class="card-body">  
                    <div class="container-lg">
                        <div class="table-responsive">
                            <div class="table-wrapper">
                            <div class="row">
                                <div class="col-md-8">
                                    <form action="{{ route('search_post') }}" method="GET" role="term">
                                        @csrf
                                        <div class="row">
                                            <div class="searchItem">keyword</div>               
                                            <div class="searchItem"><input type="text" name="term" class="form-control" placeholder=""></div>
                                            <a href="{{ route('search_post') }}" class=" mt-1">
                                            <div class="searchItem"><button type="submit" class="btn btn-primary">Search</button></div>
                                            </a>
                                        </div>
                                    </form>
                                </div>
                                <div class="postOption col-md-4">
                                    <a class="btn btn-success" href="{{ route('posts.create') }}"> Create</a>
                                    <a class="btn btn-primary" href="/posts/post/uploadIndex"> Upload</a>
                                    <a class="btn btn-primary" href="/posts/post/download"> Download</a>
                                </div>
                            </div>

                                @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                                @endif
                                @if ($message = Session::get('error'))
                                <div class="alert alert-danger">
                                    <p>{{ $message }}</p>
                                </div>
                                @endif

                                <table class="table  table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 200px;">Post title</th>
                                            <th style="min-width: 394px;">Post Description</th>
                                            <th style="min-width: 120px;">Posted User</th>
                                            <th style="min-width: 130px;">Posted Date</th>
                                            <th style="min-width: 120px;">Operation</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (!empty($posts) && $posts->count())
                                            @foreach ($posts as $post)
                                            <tr>
                                            <td><a data-toggle="modal" id="mediumButton" data-target="#mediumModal" class="text-info" style="cursor: pointer;" data-id="{{$post->id}}"> {{ $post->title }}</a></td>
                                            <td scope="col">{{ $post->description }}</td>
                                            <td scope="col">{{ $post->create_user_id == 0 ? "Admin" : "User" }}</td>
                                            <td scope="col">{{ $post->created_at->format('Y/m/d') }}</td>
                                            <td scope="col">
                                                <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                                                    <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return deleteConfirm()">Delete</button>
                                                </form>
                                            </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5">No posts to display.</td>
                                            </tr>   
                                        @endif
                                    </tbody>
                                 
                                </table>
                                <div class="d-flex float-right">
                                    {!! $posts->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Modal -->

<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Post Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mediumBody">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


<script type="text/javascript">

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    // when click detail
    $('body').on('click', '#mediumButton', function(event) {
        event.preventDefault();
        var post_id = $(this).data('id');
        let url = "{!! route('postList') !!}"
        //let url = $(this).attr('data-attr');
        $.ajax({
            url: url,
            type: 'get',
            data : {
                id: post_id
            },
            // return the result
            success: function(result) {
                // $('#mediumModal').modal("show");
                $('#mediumModal').appendTo("body");
                $('#mediumBody').html(result).show();
            },  
            complete: function() {
                $('#loader').hide();
            },
            error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("URL " + url + " cannot open. Error:" + error);
                $('#loader').hide();
            },
        })
    });

    function deleteConfirm() {
      if(!confirm("Are you sure to delete post?"))
      event.preventDefault(); 
  }
</script>

<style>
.postOption{
    text-align: right;
    padding: 15px;
}
.searchItem{
    padding: 15px;
}
</style>
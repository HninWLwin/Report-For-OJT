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
                                    <a class="btn btn-primary" href="{{ route('import') }}"> Upload</a>
                                    <a class="btn btn-primary" href="{{ route('export') }}"> Download</a>
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
                                            <td><a data-toggle="modal" id="mediumButton" data-target="#mediumModal" class="text-info" style="cursor: pointer;" 
                                            data-id="{{$post->id}}"
                                            data-title="{{$post->title}}"
                                            data-description="{{$post->description}}"
                                            data-status="{{$post->status}}"
                                            data-created_at="{{$post->created_at}}"
                                            data-create_user_id="{{Auth::user()->name}}"
                                            data-updated_at="{{$post->updated_at}}"
                                            data-updated_user_id="{{Auth::user()->name}}"> {{ $post->title }}</a></td>
                                            <td scope="col">{{ $post->description }}</td>
                                            <td scope="col">{{ $post->create_user_id == 0 ? "Admin" : "User" }}</td>
                                            <td scope="col">{{ $post->created_at->format('Y/m/d') }}</td>
                                            <td scope="col">
                                                <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                                                    <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">Edit</a>
                                                    
                                                    <button type="submit" class="btn btn-danger" a data-toggle="modal" id="deleteConfirmBtn" data-target="#delMediumModal"  
                                                    class="text-info" style="cursor: pointer;"
                                                    data-id="{{ $post->id }}"
                                                    data-title="{{$post->title}}"
                                                    data-description="{{$post->description}}" 
                                                    data-status="{{$post->status}}" data-url="{!! URL::route('posts.destroy', $post->id) !!}">Delete</a></button>
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

<!-- Modal for Post Detail -->

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
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>description
    </div>
</div>

<!-- Modal for Delete Confirmation -->
<form action="{{ route('posts.destroy',$post->id) }}" method="POST" class="remove-record-model">
@csrf
@method('DELETE')

    <div class="modal fade" id="delMediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="delConfBody">
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="deleteConfirm_post"  class="btn btn-danger ">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>

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

    // when click delete button
    $('body').on('click', '#deleteConfirmBtn', function() {
        event.preventDefault();
        var post_id = $(this).data('id');
        var post_title = $(this).data('title');
        var post_description = $(this).data('description');
        var post_status = $(this).data('status');
        let url = "{!! route('postList') !!}";
        var delurl = $(this).attr('data-url');
        
        $.ajax({
            url: url ,       
            type: 'get',
            data : {
                id: post_id,
                title: post_title,
                description: post_description,
                status: post_status
            },
            // return the result
            success: function(result) {
                $('#delConfBody').html(" <h5><b>Are you sure to delete post? </h5><br></b>" + 
                                        "ID &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp; &nbsp; " + post_id + "<br><br>" + 
                                        "Title  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;  &nbsp; " + post_title + "<br><br>" + 
                                        "Description  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; " + post_description + "<br><br>" + 
                                        "Status  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp; " + post_status ).show();
               
                $(".remove-record-model").attr("action",delurl);
            
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


 // when click detail
 $('body').on('click', '#mediumButton', function(event) {
        event.preventDefault();
        var post_id = $(this).data('id');
        var post_title = $(this).data('title');
        var post_description = $(this).data('description');
        var post_status = $(this).data('status');
        var post_created_at = $(this).data('created_at');
        var post_create_user_id = $(this).data('create_user_id');
        var post_updated_at = $(this).data('updated_at');
        var post_updated_user_id = $(this).data('updated_user_id');
        let url = "{!! route('postList') !!}"
        //let url = $(this).attr('data-attr');
        $.ajax({
            url: url,
            type: 'get',
            data : {
                id: post_id,
                title: post_title,
                description: post_description,
                status: post_status,
                created_at: post_created_at,
                create_user_id: post_create_user_id,
                updated_at: post_updated_at,
                updated_user_id: post_updated_user_id
            },
            // return the result
            success: function(result) {
                // $('#mediumModal').modal("show");
                //$('#mediumModal').appendTo("body");
                $('#mediumBody').html("Title &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;  &nbsp;      " + post_title + "<br><br>" + 
                                        "Description &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;   " + post_description + "<br><br>" + 
                                        "Status  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;     " + post_status + "<br><br>" + 
                                        "Created Date  &emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;      " + post_created_at + "<br><br>" + 
                                        "Created User  &emsp;&emsp;&emsp;&emsp;&emsp;&ensp;  " + post_create_user_id + "<br><br>" + 
                                        "Updated Date  &emsp;&emsp;&emsp;&emsp;&emsp; " + post_updated_at + "<br><br>" +
                                        "Updated User  &emsp;&emsp;&emsp;&emsp;&emsp; " + post_updated_user_id ).show();
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
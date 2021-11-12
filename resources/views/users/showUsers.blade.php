@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('User List') }}</div>

                <div class="card-body">  
                    <div class="container-lg">
                        <div class="table-responsive">
                            <div class="table-wrapper">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('search_user') }}" method="GET" role="q">
                                    @csrf
                                        <div class="row"> 
                                            <div class="searchItem">Name</div>   
                                            <div class="searchItem col"><input type="text" name="q" class="form-control" placeholder=""></div>
                                            <div class="searchItem">Email</div>   
                                            <div class="searchItem col"><input type="email" name="q" class="form-control" placeholder=""></div>
                                            <div class="searchItem">From</div>   
                                            <div class="searchItem col"><input type="date" name="q" class="form-control " placeholder=""></div>
                                            <div class="searchItem">To</div>   
                                            <div class="searchItem col"><input type="date" name="q" class="form-control " placeholder=""></div>
                                            <a href="{{ route('search_user') }}" class=" mt-1">
                                                <div class="searchItem"><button type="submit" class="btn btn-primary">Search</button></div>
                                            </a>
                                        </div>
                                    </form>
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
                                            <th style="min-width: 200px;">Name</th>
                                            <th style="min-width: 120px;">Email</th>
                                            <th style="min-width: 130px;">Created User</th>
                                            <th style="min-width: 120px;">Type</th>
                                            <th style="min-width: 120px;">Phone</th>
                                            <th style="min-width: 130px;">Date of Birth</th>
                                            <th style="min-width: 130px;">Address</th>
                                            <th style="min-width: 130px;">Created_date</th>
                                            <th style="min-width: 130px;">Updated_date</th>
                                            <th style="min-width: 250px;">Operation</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (!empty($users) && $users->count())
                                            @foreach ($users as $user)
                                            <tr>
                                                <td><a data-toggle="modal" id="mediumButton" data-target="#mediumModal" class="text-info" style="cursor: pointer;" data-attr="{{$user->id}}"> {{ $user->name }}</a></td>
                                                <td scope="col">{{ $user->email }}</td>
                                                <td scope="col">{{ Auth::user()->name }}</td>
                                                <td scope="col">{{ $user->type == 0 ? "Admin" : "User" }}</td>
                                                <td scope="col">{{ $user->phone }}</td>
                                                <td scope="col">{{ $user->dob }}</td>
                                                <td scope="col">{{ $user->address }}</td>
                                                <td scope="col">{{ $user->created_at }}</td>
                                                <td scope="col">{{ $user->updated_at }}</td>
                                                <td scope="col">
                                                    
                                                        <button type="submit" class="btn btn-danger " onclick="return confirm('Are you sure want to delete user?')" href="{{ route('users.destroy',$user->id) }}" >Delete</button>
                                                    
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5">There are no data.</td>
                                            </tr>   

                                            
                                        @endif
                                    </tbody>
                                 
                                </table>
                                <div class="d-flex float-right">
                                    {!! $users->links() !!}
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
                <h5 class="modal-title" id="exampleModalLongTitle">User Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mediumBody">
               Name -> {{ $user->name }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery .dataTables.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


<script type="text/javascript">
    function deleteConfirm() {
      if(!confirm("Are you sure to delete user?"))
      event.preventDefault(); 
}
    // when click detail
    $('body').on('click', '#mediumButton', function(event) {
        event.preventDefault();
        let href = $(this).id('data-id');
        alert(href);
        $.ajax({
            url: href,
            beforeSend: function() {
                $('#loader').show();
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
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            },
        })
    });
  }

  
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
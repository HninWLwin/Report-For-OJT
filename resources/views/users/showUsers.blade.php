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
                                                <td><a data-toggle="modal" id="mediumButton" data-target="#mediumModal" class="text-info" style="cursor: pointer;" 
                                                data-id="{{$user->id}}"
                                                data-name="{{$user->name}}"
                                                data-type="{{$user->type}}"
                                                data-email="{{$user->email}}"
                                                data-phone="{{$user->phone}}"
                                                data-dob="{{$user->dob}}"
                                                data-address="{{$user->address}}"
                                                data-profile="{{$user->profile}}"
                                                data-created_at="{{$user->created_at}}"
                                                data-create_user_id="{{Auth::user()->name}}"
                                                data-updated_at="{{$user->updated_at}}"
                                                data-updated_user_id="{{Auth::user()->name}}"> {{ $user->name }}</a></td>
                                                <td scope="col">{{ $user->email }}</td>
                                                <td scope="col">{{ Auth::user()->name }}</td>
                                                <td scope="col">{{ $user->type == 0 ? "Admin" : "User" }}</td>
                                                <td scope="col">{{ $user->phone }}</td>
                                                <td scope="col">{{ $user->dob }}</td>
                                                <td scope="col">{{ $user->address }}</td>
                                                <td scope="col">{{ $user->created_at }}</td>
                                                <td scope="col">{{ $user->updated_at }}</td>
                                                <td scope="col">
                                                    <button type="submit" class="btn btn-danger" a data-toggle="modal" id="deleteConfirmBtn" data-target="#delMediumModal"  
                                                        class="text-info" style="cursor: pointer;"
                                                        data-id="{{ $user->id }}"
                                                        data-name="{{ $user->name }}"
                                                        data-type="{{ $user->type }}" 
                                                        data-email="{{ $user->email }}"
                                                        data-phone="{{ $user->phone }}"
                                                        data-dob="{{ $user->dob }}" 
                                                        data-address="{{ $user->address }}"
                                                        data-url="{!! URL::route('users.destroy', $user->id) !!}">Delete</a>
                                                    </button>
                                                    <!-- Modal for Delete Confirmation -->
                                                    <form action="{{ route('users.destroy',$user->id) }}" method="POST" class="remove-record-model">
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
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                            <!-- Pagination  -->
                                            <div class="d-flex float-right">
                                                {!! $users->links() !!}
                                            </div>

                                        @else
                                            <tr>
                                                <td >No data available in table.</td>
                                            </tr>   
                                            
                                        @endif
                                    </tbody>
                                 
                                </table>
                               
                            </div>
                        </div>
                    </div>     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Modal for user detail -->

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
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

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
        var user_id = $(this).data('id');
        var user_name = $(this).data('name');
        var user_type = $(this).data('type');
        var user_email = $(this).data('email');
        var user_phone = $(this).data('phone');
        var user_dob = $(this).data('dob');
        var user_address = $(this).data('address');
        let url = "{!! route('showUsers') !!}";
        var delurl = $(this).attr('data-url');
        
        $.ajax({
            url: url ,       
            type: 'get',
            data : {
                id: user_id,
                name: user_name,
                type: user_type,
                email: user_email,
                phone: user_phone,
                dob: user_dob,
                address: user_address,
            },
            // return the result
            success: function(result) {
                $('#delConfBody').html(" <h5><b>Are you sure to delete user? </h5><br></b>" + 
                                        "ID &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp; &nbsp; " + user_id + "<br><br>" + 
                                        "Name  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;  " + user_name + "<br><br>" + 
                                        "Type  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;" + user_type + "<br><br>" + 
                                        "Email  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp; " + user_email  + "<br><br>" + 
                                        "Phone  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;  " + user_phone + "<br><br>" + 
                                        "Date of Birth  &emsp;&emsp;&emsp;&emsp;&emsp; " + user_dob + "<br><br>" + 
                                        "Address  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; " + user_address).show();
               
                $(".remove-record-model").attr("action",delurl);
            
            },  
            complete: function() {
                $('#loader').hide();
            },
            error: function(jqXHR, testStatus, error) {
               // console.log(error);
                alert("URL " + url + " cannot open. Error:" + error);
                $('#loader').hide();
            },
        })
    });


    // when click detail
    $('body').on('click', '#mediumButton', function(event) {
        event.preventDefault();
        var user_id = $(this).data('id');
        var user_name = $(this).data('name');
        var user_type = $(this).data('type');
        var user_email = $(this).data('email');
        var user_phone = $(this).data('phone');
        var user_dob = $(this).data('dob');
        var user_address = $(this).data('address');
        var user_profile = $(this).data('profile');
        var user_created_at = $(this).data('created_at');
        var user_create_user_id = $(this).data('create_user_id');
        var user_updated_at = $(this).data('updated_at');
        var user_updated_user_id = $(this).data('updated_user_id');
        let url = "{!! route('showUsers') !!}"
        $.ajax({
            url: url,
            type: 'get',
            data : {
                id: user_id,
                name: user_name,
                type: user_type,
                email: user_email,
                phone: user_phone,
                dob: user_dob,
                address: user_address,
                profile: user_profile,
                created_at: user_created_at,
                create_user_id: user_create_user_id,
                updated_at: user_updated_at,
                updated_user_id: user_updated_user_id
            },
            // return the result
            success: function(result) {
                $('#mediumBody').html("<img src =/uploads/images/" + user_profile + " style='width:150px;height:150px'><br>" + "Name  - " + user_name + "<br>" + 
                                        "Type  - " + user_type + "<br>" + 
                                        "Email  - " + user_email + "<br>" + 
                                        "Phone  - " + user_phone + "<br>" + 
                                        "Date of Birth  - " + user_dob + "<br>" + 
                                        "Address  - " + user_address + "<br>" + 
                                        "Created Date  - " + user_created_at + "<br>" + 
                                        "Created User  - " + user_create_user_id + "<br>" + 
                                        "Updated Date  - " + user_updated_at + "<br>" +
                                        "Updated User  - " + user_updated_user_id ).show();
            
            },  
            complete: function() {
                $('#loader').hide();
            },
            error: function(jqXHR, testStatus, error) {
                //console.log(error);
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
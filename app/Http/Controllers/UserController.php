<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StoreUserRegistrationRequest;
use App\Http\Requests\StoreUserPasswordChangeRequest;
use Illuminate\Http\Request;
use App\Contracts\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userInterface;

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserServiceInterface $userInterface)
    {
        $this->middleware('auth');
        $this->userInterface = $userInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userInterface->getUserList();

        return view('users/showUsers', compact('users'))
        ->with('i', (request()->input('page', 1)-1)*5);
    }

    /**
     * search user data.
     *
     * 
     */
    public function find(Request $request)
    {
        $users = $this->userInterface->getSearchData( $request);

        return view('users/showUsers',['users' => $users])
        ->with('i', (request()->input('page', 1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    public function confirm_registration(StoreUserRegistrationRequest $request)
    {
        $user = new User($request->all());
        return view('users.confirm_registration', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRegistrationRequest $request)
    {
        //dd($request);
        $this->userInterface->storeUser($request);     
       
        return redirect()->route('showUsers')   
        ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.userEdit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->userInterface->updateProfile($request, $user);
         
         return redirect()->route('showUsers')
         ->with('success', 'User Profile successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userInterface->deleteUser($user);

        return redirect()->route('showUsers')
            ->with('success','User deleted successfully.!');
    }

    public function profile(User $user)
    {
        return view('users.profile', compact('user'));
    }

    public function change_password(Request $request, User $user)
    {
        return view('users.change_password');
    }

    public function update_password(StoreUserPasswordChangeRequest $request)
    {
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        
        return redirect()->route('showUsers')
            ->with('success', 'Password is successfully updated.');;
         
    }
}

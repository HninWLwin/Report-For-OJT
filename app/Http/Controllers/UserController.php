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

        return view('users/showUsers', compact('users'));
    }

    /**
     * search user data.
     *
     * 
     */
    public function find(Request $request)
    {
        $users = $this->userInterface->getSearchData( $request);

        return view('users/showUsers',['users' => $users]);
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

        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $filename = time() . '.' . $profile->getClientOriginalExtension();
            Image::make($profile)->resize(300, 300)->save(storage_path('/uploads/' . $filename));
            $user->profile = $filename;
        } 

         dd($user);

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

    /**
     * Show the user's profile.
     *
     * 
     **/
    public function profile(User $user)
    {
        return view('users.profile', compact('user'));
    }

    /**
     * Show the form to update passsword
     * 
     */
    public function change_password(Request $request, User $user)
    {
        return view('users.change_password');
    }

    /**
     * Update user's password
     * 
     */
    public function update_password(StoreUserPasswordChangeRequest $request)
    {
        $this->userInterface->updatePassword($request);    
        
        return redirect()->route('showUsers')
            ->with('success', 'Password is successfully updated.');;
         
    }
}

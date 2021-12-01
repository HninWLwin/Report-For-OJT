<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRegistrationRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Contracts\Services\User\UserServiceInterface;


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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $start = $request->input('start');
        $end = $request->input('end');
        if($end != null && $end != "" && $start > $end){
            return redirect()->route('showUsers')->with('error', 'Start date is greater than End date');
        }
        $users = $this->userInterface->searchUserList($name, $email, $start, $end);

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
            $filename = $request->profile->getClientOriginalName();
            $path = $request->profile->storeAs('images', $filename, 'public');
            $user->profile = $filename;
        }
        return view('users.confirm_registration', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User($request->all());
        $this->userInterface->storeUser($user);
       
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
    public function update(UpdateUserRequest $request, User $user)
    {
        $user = new User($request->all());
        if ($request->hasFile('profile')) {
            $filename = $request->profile->getClientOriginalName();
            $path = $request->profile->storeAs('images', $filename, 'public');
            $user->profile = $filename;
        }
        $user->id = $request->user->id;
        $this->userInterface->updateProfile($user);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     **/
    public function profile(User $user)
    {
        return view('users.profile', compact('user'));
    }

    /**
     * Show the form to update passsword
     * 
     */
    public function change_password()
    {
        return view('users.change_password');
    }

    /**
     * Update user's password
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_password(ChangePasswordRequest $request)
    {
        $this->userInterface->updatePassword($request);    
        
        return redirect()->route('showUsers')
            ->with('success', 'Password is successfully updated.');;
         
    }
}

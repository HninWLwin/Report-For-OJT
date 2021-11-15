<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
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

    public function confirm_registration(StoreUserRequest $request)
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
    public function store(StoreUserRequest $request)
    {
        //dd($request);
        $this->userInterface->storeUser($request);     
       
        return redirect()->route('users/showUsers')
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserRequest $request, $id)
    {
        //
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
}

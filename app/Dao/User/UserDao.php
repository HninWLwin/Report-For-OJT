<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Storage;
use DateTime;

class UserDao implements UserDaoInterface
{
  /**
   * get user data from table
   * 
   * @return array
   */
  public function getUserList()
  {
    if(auth()->user()->type == 1){
        $users = User::where('id', auth()->user()->id)->paginate(5);
    }
    else{
        $users = User::latest()->paginate(5);  

    }

    return $users;
  }

  public function searchUserList($name, $email, $start, $end)
  {
    $user = User::where(function ($users) use ($name, $email, $start, $end) {
        $users->where('name', 'LIKE', '%' . $name . '%')
            ->where('email', 'LIKE', '%' . $email . '%')->get();
        if ($start != null or $start != "") $users->where('created_at', '>=', $start)->get();
        if ($end != null or $end != "") $users->where('created_at', '<=', $end)->get();
    })
    ->orderBy("id")
    ->paginate(5);

    return $user;

  }

  /**
   * store user data to table
   * 
   * @return object
   */
  public function storeUser($user)
  {
    DB::transaction(function()use ($user){
        try {
          $result = User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $user['password'],
            'profile' => $user['profile'],
            'type' => $user['type'],
            'phone' => $user['phone'],
            'address' => $user['address'],
            'dob' => $user['dob'],
            'create_user_id' => $user['create_user_id'],
            'updated_user_id' => $user['updated_user_id'],
        ]);
        } catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        return $result;
    });
  }

  /**
     * 
     * Update user data to table
     *
     * @return object
     */
    public function updateProfile($user)
    {
      DB::transaction(function()use ($user){
        try {
          $result = User::where('id', $user->id)->update([
                  'name' => $user['name'],
                  'email' => $user['email'],
                  'type' => $user['type'],
                  'phone' => $user['phone'],
                  'address' => $user['address'],
                  'dob' => $user['dob'],
                  'profile' => $user['profile'],
          ]);
        } catch (\Exception $e){
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
      
      return $result;
    });
      

    }

    /**
     * 
     * Delete user data from table
     *
     * @return object
     */
    public function deleteUser($user)
    {
      DB::transaction(function()use ($user){
        try {
          $result =  User::where('id', $user['id'])->update($user);
        } catch (\Exception $e){
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        return $result;
      });
    }

     /**
     * 
     * Change password 
     *
     */
    public function updatePassword($request)
    {
        $result =  User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        
        return $result;
    }

}

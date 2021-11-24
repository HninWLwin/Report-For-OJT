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

  public function getSearchData($request)
  {
    $users = User::where([
        [function($query) use ($request) {
            if(($q = $request->q)) {
                $query->orWhere('name', 'like', '%'.$q.'%')
                    ->orWhere('email', 'like', '%'.$q.'%')
                    ->orWhere('created_at', 'like', '%'.$q.'%')
                    ->orWhere('updated_at', 'like', '%'.$q.'%')->get();
            }
        }]
    ])
        ->orderBy("id")
        ->paginate(5);
        
    return $users;

  }

  /**
   * store user data to table
   * 
   * @return object
   */
  public function storeUser($request)
  {
      $result['password'] = Hash::make(auth()->user()->password);
      $result['type'] = auth()->user()->type == 'Admin' ? 0 : 1;
      $user['dob'] = new DateTime(auth()->user()->dob);
      $result['create_user_id'] = auth()->user()->id;
      $result['updated_user_id'] = auth()->user()->id;
      $result['created_at'] = new DateTime();
      $result['updated_at'] = new DateTime();
      $result = User::create($result);

      return $result;
  }

  /**
     * 
     * Update user data to table
     *
     * @return object
     */
    public function updateProfile($request, $user)
    {
        if($request->hasFile('profile')){
            $filename = $request->profile->getClientOriginalName();
            $request->profile->storeAs('images',$filename,'public');
            Auth()->user()->update(['profile'=>$filename]);
        }
        $result = $user->update($request->all());

        return $result;
    }

    /**
     * 
     * Delete user data from table
     *
     * @return object
     */
    public function deleteUser($user)
    {
        $result =  $user->delete();
        
        return $result;
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

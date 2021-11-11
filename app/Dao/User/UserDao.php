<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;
use DB;

class UserDao implements UserDaoInterface
{
  /**
   * get user data from table
   * 
   * @return array
   */
  public function getUserList()
  {
    $users = User::latest()->paginate(5);  

    return $users;
  }

  public function getSearchData($request)
  {
    $users = User::where([
        [function($query) use ($request) {
            if(($q = $request->q)) {
                $query->orWhere('name', 'like', '%'.$q.'%')->get();
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
      $result = $request->all();
      $result = User::create($result);

      return $result;
  }

  /**
     * 
     * Update user data to table
     *
     * @return object
     */
    public function updateUser($request, $user)
    {
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

}

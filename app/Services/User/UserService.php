<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\Hash;
use DateTime;

class UserService implements UserServiceInterface
{
  private $userDao;

  /**
   * Class Constructor
   * @param UserDaoInterface $postDao
   * @return
   */
  public function __construct(UserDaoInterface $userDao)
  {
    $this->userDao = $userDao;
  }

  /**
     * 
     * Get user data from table
     *
     * @return array
     */
    public function getUserList()
    {   
        $users = $this->userDao->getUserList();

        return $users;
    }

    /**
     * Search users
     * 
     * @param name,email,start,end
     */
    public function searchUserList($name, $email, $start, $end)
    {
        $result = $this->userDao->searchUserList($name, $email, $start, $end);

        return $result;
    }

    /**
     * 
     * Store user data to table
     *
     * @return object
     */
    public function storeUser($user)
    {
        $user->password = Hash::make($user->password);
        $user->type = $user->type == 'Admin' ? 0 : 1;
        $user->dob = new DateTime(auth()->user()->dob);
        $user->create_user_id = auth()->user()->id;
        $user->updated_user_id = auth()->user()->id;
        $user->created_at = new DateTime(); 
        $user->updated_at = new DateTime();
        $result = $this->userDao->storeUser($user);
        
        return $result;
    }

    /**
     *
     * Update user data to table
     *
     * @return object
     */
    public function updateProfile($user)
    {
        $user->updated_user_id = auth()->user()->id;
        
        $result = $this->userDao->updateProfile($user);
        
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
        $user = [
            'id' => $user['id'],
            'deleted_at' => now(),
            'deleted_user_id' => auth()->user()->id
        ];
        $result = $this->userDao->deleteUser($user);
        
        return $result;
    }

     /**
     * 
     * Change password
     *
     */
    public function updatePassword($request)
    {
        $result = $this->userDao->updatePassword($request);
        
        return $result;
    }
}

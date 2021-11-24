<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;

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

    // search data
    public function getSearchData($request)
    {
        $result = $this->userDao->getSearchData($request);

        return $result;
    }

    /**
     * 
     * Store user data to table
     *
     * @return object
     */
    public function storeUser($request)
    {
        $result = $this->userDao->storeUser($request);
        
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     *
     * Update user data to table
     *
     * @return object
     */
    public function updateProfile($request, $user)
    {
        $result = $this->userDao->updateProfile($request, $user);
        
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 
     * Delete user data from table
     *
     * @return object
     */
    public function deleteUser($user)
    {
        $result = $this->userDao->deleteUser($user);
        
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

     /**
     * 
     * Change password
     *
     */
    public function updatePassword($request)
    {
        $result = $this->userDao->updatePassword($request);
        
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
}

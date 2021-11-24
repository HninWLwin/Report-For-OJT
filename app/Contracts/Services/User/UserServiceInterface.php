<?php

namespace App\Contracts\Services\User;

interface UserServiceInterface
{
  //get user list
  public function getUserList();

  /**
     * 
     * Store user data to table
     *
     * @return object
     */
    public function storeUser($request);


    /**
     * 
     * Update user data to table
     *
     * @return object
     */
    public function updateProfile($request, $user);


    /**
     * 
     * Delete user data from table
     *
     * @return object
     */
    public function deleteUser($user);

     /**
     * 
     * Change password
     *
     */
    public function updatePassword($request);
}

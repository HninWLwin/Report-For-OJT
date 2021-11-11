<?php

namespace App\Contracts\Dao\User;

interface UserDaoInterface
{
  /**
     * 
     * Get user data from table
     *
     * @return array
     */
  public function getUserList();

   // search data
   public function getSearchData($request);

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
    public function updateUser($request, $user);

    /**
     * 
     * Delete user data from table
     *
     * @return object
     */
    public function deleteUser($user);
}

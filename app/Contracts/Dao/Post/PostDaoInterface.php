<?php

namespace App\Contracts\Dao\Post;

interface PostDaoInterface
{
  /**
     * 
     * Get Post data from table
     *
     * @return array
     */
  public function getPostList();

   // search data
   public function getSearchData($request);

  /**
     * 
     * Store post data to table
     *
     * @return object
     */
    public function storePost($post);

    /**
     * 
     * Update post data to table
     *
     * @return object
     */
    public function updatePost($post);

    /**
     * 
     * Delete post data from table
     *
     * @return object
     */
    public function deletePost($post);
}

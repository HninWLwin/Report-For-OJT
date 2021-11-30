<?php

namespace App\Contracts\Services\Post;

interface PostServiceInterface
{
  //get post list
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

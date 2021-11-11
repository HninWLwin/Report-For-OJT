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
    public function storePost($request);


    /**
     * 
     * Update post data to table
     *
     * @return object
     */
    public function updatePost($request, $post);


    /**
     * 
     * Delete post data from table
     *
     * @return object
     */
    public function deletePost($post);
}

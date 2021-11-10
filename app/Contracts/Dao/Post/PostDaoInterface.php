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

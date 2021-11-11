<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;

class PostService implements PostServiceInterface
{
  private $postDao;

  /**
   * Class Constructor
   * @param PostDaoInterface $postDao
   * @return
   */
  public function __construct(PostDaoInterface $postDao)
  {
    $this->postDao = $postDao;
  }

  /**
     * 
     * Get product data from table
     *
     * @return array
     */
    public function getPostList()
    {   
        $posts = $this->postDao->getPostList();

        return $posts;
    }

    // search data
    public function getSearchData($request)
    {
        $result = $this->postDao->getSearchData($request);

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 
     * Store post data to table
     *
     * @return object
     */
    public function storePost($request)
    {
        $result = $this->postDao->storePost($request);

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     *
     * Update post data to table
     *
     * @return object
     */
    public function updatePost($request, $post)
    {
        $result = $this->postDao->updatePost($request, $post);
        
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 
     * Delete post data from table
     *
     * @return object
     */
    public function deletePost($post)
    {
        $result = $this->postDao->deletePost($post);
        
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
}

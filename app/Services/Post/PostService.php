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


    /**
     * Search data 
     * 
     */
    public function getSearchData($request)
    {
        $result = $this->postDao->getSearchData($request);

        return $result;
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

        return $result;
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
        
        return $result;
    }

    /**
     * 
     * Delete post data from table
     *
     * @return object
     */
    public function deletePost($post)
    {
        $post = [
            'id' => $post['id'],
            'deleted_at' => now(),
            'deleted_user_id' => auth()->user()->id
        ];
        $result = $this->postDao->deletePost($post);
        
        return $result;
    }
}

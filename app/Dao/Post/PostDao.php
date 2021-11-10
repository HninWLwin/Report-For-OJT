<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;
use DB;

class PostDao implements PostDaoInterface
{
  /**
   * get post data from table
   * 
   * @return array
   */
  public function getPostList()
  {
    $posts = Post::latest()->paginate(5);  

    return $posts;
  }

  /**
   * store post data to table
   * 
   * @return object
   */
  public function storePost($request)
  {
      $result = $request->all();
      $result['create_user_id'] = auth()->id();
      $result['updated_user_id'] = auth()->id();

      $result = Post::create($result);

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
        $result = $post->update($request->all());

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
        $result =  $post->delete();
        
        return $result;
    }

}

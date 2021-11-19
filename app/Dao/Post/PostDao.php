<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;
use DB;
use DateTime;

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

  public function getSearchData($request)
  {
    $posts = Post::where([
        [function($query) use ($request) {
            if(($term = $request->term)) {
                $query->orWhere('title', 'like', '%'.$term.'%')
                    ->orWhere('description', 'like', '%'.$term.'%')->get();
            }
        }]
    ])
        ->orderBy("id")
        ->paginate(5);
        
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
      
      $result['create_user_id'] = auth()->user()->type;
      $result['updated_user_id'] = auth()->user()->type;
      
      $result['created_at'] = new DateTime();
      $result['updated_at'] = new DateTime();
      
      $result = Post::create($result);
      //dd($result);

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
        $result['status'] = $request->has('status') ? 1 : false;
        $result['updated_user_id'] = auth()->user()->id;
        $result['updated_at'] = new DateTime();
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

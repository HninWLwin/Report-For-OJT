<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
    if(auth()->user()->type == 1){
        $posts = Post::where('create_user_id', auth()->user()->id)->paginate(5);
    }
    else{
        $posts = Post::latest()->paginate(5);  

    }

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
  public function storePost($post)
  {  
    DB::transaction(function()use ($post){
        try {
            $result = Post::create($post);
        } catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        
        return $result;
    });
  }

  /**
     * 
     * Update post data to table
     *
     * @return object
     */
    public function updatePost($post)
    {
        DB::transaction(function()use ($post){
            try {
                $result = Post::where('id', $post['id'])->update($post);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        
            return $result;
        });
    }

    /**
     * 
     * Delete post data from table
     *
     * @return object
     */
    public function deletePost($post)
    {
        DB::transaction(function()use ($post){
            try {
                $result =  POST::where('id', $post['id'])->update($post);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        
            return $result;
        });
    }

}

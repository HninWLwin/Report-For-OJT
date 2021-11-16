<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use App\Contracts\Services\Post\PostServiceInterface;
use DB;

class PostController extends Controller
{

    private $postInterface;

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostServiceInterface $postInterface)
    {
        $this->middleware('auth');
        $this->postInterface = $postInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postInterface->getPostList();
        
        return view('postList', compact('posts'))
        ->with('i', (request()->input('page', 1)-1)*5);
    }

    public function find(Request $request)
    {
        $posts = $this->postInterface->getSearchData( $request);
        return view('postList',['posts' => $posts])
        ->with('i', (request()->input('page', 1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    public function post_confirm_registration(StorePostRequest $request)
    {
       // dd($request);
        $post = new Post($request->all());
        return view('posts.post_confirm_registration', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $this->postInterface->storePost($request);     
        
        return redirect()->route('postList')
        ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('postList', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

      /**
     * For update confirmation
     *
     * 
     * 
     */
    public function update_confirm(StorePostRequest $request)
    {
        $post = new Post($request->all());
        $post->status = $request->has('status') ? 1 : 0;
        //dd($post);
        return view('posts.update_confirm', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
       // dd($request);
         $this->postInterface->updatePost($request, $post);
         $post->status = $request->has('status') ? 1 : false;
         
         return redirect()->route('postList')
         ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->postInterface->deletePost($post);
        return redirect()->route('postList')
            ->with('success','Post deleted successfully.!');
    }
}

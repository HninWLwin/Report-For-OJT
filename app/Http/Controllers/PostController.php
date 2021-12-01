<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\FileUploadRequest;
use Illuminate\Http\Request;
use App\Exports\PostsExport;
use App\Imports\PostsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Contracts\Services\Post\PostServiceInterface;

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

        return view('postList', compact('posts'));
    }

    /**
     * Search data in post table .
     *
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        $posts = $this->postInterface->getSearchData( $request);

        return view('postList',['posts' => $posts]);
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

    public function postConfirmRegistration(StorePostRequest $request)
    {
        $post = new Post($request->all());

        return view('posts.post_register_confirm', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post($request->all());
        $this->postInterface->storePost($post);  
       
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
     */
    public function update_confirm(StorePostRequest $request,  $id)
    {
        $post = new Post($request->all());
        $post->id = $id;
        $post->status = $request->has('status') ? 1 : 0;
        return view('posts.update_confirm', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StorePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $this->postInterface->updatePost($request, $post);
        
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

    /**
     * Show the form for file upload
     * 
     */
    public function fileImportExport()
    {
        return view('posts.upload');
    }

    /**
     * Read uploaded file and store read data into DB
     * 
     * @param  \Illuminate\Http\FileUploadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function fileImport(FileUploadRequest $request)
    {
        Excel::import(new PostsImport, $request->file('file')->store('temp'));
      
        return redirect()->route('postList')
            ->with('success', 'Post uploaded successfully.');
    }

    /**
     * Download post lists  
     * 
     */
    public function export() 
    {
        return Excel::download(new PostsExport, 'posts.csv');
    }
}

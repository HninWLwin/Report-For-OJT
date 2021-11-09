<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Contracts\Services\Post\PostServiceInterface;
use Illuminate\Support\Facades\Input;
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
        //$posts = $this->postInterface->getPostList();

        $postLists = DB::table('posts')->orderBy('created_at', 'DESC')->paginate(3);   // need to edit in dao

        return view('postList', ['posts' => $postLists]);
    }

    public function find(Request $request)
    {
        //$posts = $this->postInterface->getPostList();

        $search =  $request->input('keyword');

            $searchData = Post::where('title', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')->get();
                    if (count ( $searchData ) > 0)
                        return view ( 'postList' )->withDetails ( $searchData )->withQuery ( $search );
                    else
                        return view ( 'postList' )->withMessage ( 'No Details found. Try to search again !' );		
        
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
        $request->validate([    
            'title' => 'required',
            'description' => 'required',
        ]);

         Post::create($request->all());
         $data['create_user_id']=$user->id;

        return redirect('postList')->with('success', 'Post created successfully.!');
  
        // auth()->user()->posts()->create([    
        //     'title' => $data['title'],   
        //     'description' => $data['description'],
        //     'status' => $data['status']  
        // ]); 

        // return redirect()->route('home', ['user' => auth()->user() ]
        //                 ->with('success', 'Post created successfully.'));
   
        // return redirect()->route('home')
        //                 ->with('success','Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('postList',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();

        return redirect()->route('postList')
            ->with('success','Post deleted successfully');
    }

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
}

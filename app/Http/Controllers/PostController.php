<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  $data = Post::latest()->paginate(5);
  
        //  return view('home',compact('data'))
        //      ->with('i', (request()->input('page', 1) - 1) * 5);

        //$posts = Post::all();
        return view('home', compact('posts'));

        $search =  $request->input('keyword');
        if($search!=""){
            $Members = Member::where(function ($query) use ($search){
                $query->where('title', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
            })
            ->paginate(2);
            $Members->appends(['keyword' => $search]);
        }
        else{
            $Members = Member::paginate(2);
        }
        return View('home')->with('data',$Members);
        //
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
            'status' => 'required',
        ]);

         Post::create($request->all());

        //$posts = Post::create($request->all());
       
        return redirect('home')->with('success', 'Post created successfully.!');
  
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
        return view('home',compact('post'));
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
    public function destroy(Post $post)
    {
        //
    }

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
}

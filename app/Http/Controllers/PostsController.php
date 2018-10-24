<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;
use Auth;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        //return Post::where('title', 'Post One')->get();
        //$posts = Post::orderBy('title','desc')->take(1)->get();
        //$posts = Post::orderBy('title','desc')->get();

        // show only available posts to logged in users
        if(Auth::check())
        {
            //take posts by descending order of creation which are all or field with faculty of logged user
            $posts = Post::orderBy('created_at','desc')
                    ->where('access','all')
                    ->orWhere(function($query){
                        return $query->where('access','field')
                                    ->where('faculty',auth()->user()->faculty);
                    })
                    ->orWhere(function($query){
                        return $query->where('access','none')
                                    ->where('user_id',auth()->user()->id);
                    })
                    ->paginate(10);
        }
        // show all posts to logged out users. maybe for visitors and not limiting login
        else{
            $posts = Post::orderBy('created_at','desc')->paginate(10);
        }

        //$posts=DB::select("SELECT * FROM posts ORDER BY title DESC");
        return view('posts.index')->with('posts', $posts);
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'faculty' => 'required',
            'access' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle file upload
        if($request->hasFile('cover_image'))
        {
            // get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // get jst filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension= $request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            $path= $request->file('cover_image')->storeAs('public/cover_images',$filenameToStore);
        }
        else{
            $filenameToStore='noimage.jpg';
        }

        $post = new Post();
        $post->title = $request->input('title');

        //wrap a long word (tested for longest english word which is 45 char long)
        $post->body = wordwrap($request->input('body'),50,' ',true);
        
        $post->user_id = auth()->user()->id;
        $post->cover_image=$filenameToStore;
        $post->faculty=$request->input('faculty');
        $post->access= $request->input('access');
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if(count($post)>0)
        {
            //change access to readable format
            $field=array(
                'none' => 'Only Me',
                'all' => 'All fields',
                'field' => 'My field only'
            );   
            $post->access=$field[$post->access];

            return view('posts.show')->with('post', $post);
        }
        else{
            return redirect('/posts')->with('error', 'Post Not Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post= Post::find($id);

        // Check for user id
        if(count($post)>0)
        {
            if(auth()->user()->id !=$post->user_id)
            {
                return redirect('/posts')->with('error', 'Unauthorized Page'); 
            }
            return view('posts.edit')->with('post',$post);
        }
        else
        {
            return redirect('/posts')->with('error', 'Post Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'access' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
        
        if($request->hasFile('cover_image'))
        {
            // get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // get jst filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension= $request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            $path= $request->file('cover_image')->storeAs('public/cover_images',$filenameToStore);
        }

        $post = Post::find($id);
        $post->title = $request->input('title');

        //wrap a long word (tested for longest english word which is 45 char long)
        $post->body = wordwrap($request->input('body'),50,' ',true);

        $post->access= $request->input('access');
        if($request->hasFile('cover_image')){
            $post->cover_image= $filenameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(count($post)>0)
        {
            if(auth()->user()->id !=$post->user_id)
            {
                return redirect('/posts')->with('error', 'Unauthorized Page'); 
            }

            if($post->cover_image != "noimage.jpeg"){
                //delete image
                Storage::delete('public/cover_images/'.$post->cover_image); 
            }

            $post->delete();
            return redirect('/posts')->with('success', 'Post Removed'); 
        }
        else
        {
            return redirect('/posts')->with('error', 'Post Not Found');
        }
    }
}

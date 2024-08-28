<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //retrieve all post from DB
        $posts = Post::latest()->paginate(6);
        //redirect to posts page
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //validate
        $fields = $request->validate([
            'title' => ['required','max:255'],
            'body' => ['required'],
            'image'=> ['nullable','file','max:2000','mimes:png,jpg,gif,webp'],
        ]);

        $imagePath = null;
        if($request->hasFile('image')){
            $imagePath = Storage::disk('public')->put('post_images',$request->image);
        }
        //create post
        Auth::user()->posts()->create([
            'title' => $fields['title'],
            'body' => $fields['body'],
            'image_path' => $imagePath,
        ]);
        //Post::create(['user_id'=> Auth::id(),'title'=>$fields['title'],'body'=>$fields['body']]);
        // //route to homepage
        return back()->with('success','Post created successfully!'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show',['post'=> $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //dd($post);
        Gate::authorize('verify',$post);
        return view('posts.edit', ['post'=> $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        Gate::authorize('verify',$post);
        //validate
        $fields = $request->validate([
            'title' => ['required','max:255'],
            'body' => ['required'],
            'image'=> ['nullable','file','max:2000','mimes:png,jpg,gif,webp'],
        ]);
        //update post
        $imagePath = $post-> image_path ?? null;
        if($request->hasFile('image')){
            if($post->image_path){
                Storage::disk('public')->delete($post->image_path);
            }
            $imagePath = Storage::disk('public')->put('post_images',$request->image);
        }
        $post->update([
            'title' => $fields['title'],
            'body' => $fields['body'],
            'image_path' => $imagePath,
        ]);
        // //route to homepage
        return redirect('dashboard')->with('success','Post updated successfully!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Gate::authorize('verify',$post);
        //de;ete image if exists
        if($post->image_path){
            Storage::disk('public')->delete($post->image_path);
        }

        $post->delete();
        return back()->with('delete','Post deleted successfully!');
    }

    public function userPosts(User $user){

        $userPosts = $user->posts()->latest()->paginate(6);
        $username = $user->username;
        //route to user's posts page
        return view('users.posts',[
            'posts'=> $userPosts,
            'username'=> $username,
        ]);
    }
}

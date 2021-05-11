<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class postsController extends Controller
{
    public function __construct()
    {
      $this->middleware('check_category')->only('create');
       
     }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('posts.index')->with('posts', post::all());
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('posts.create')->with('categories', category::all())->with('tags', Tag::all());
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $post = new  Post();

        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content; 
        $post->category_id = $request->categoryID;
        $post->user_id =Auth::id();
        $post->image = $request->image->store('images', 'public');
     
        $post->save();
        if ($request->tags) {
          $post->tags()->attach($request->tags);
        } 
      
    
       
        session()->flash('success', 'post created successfully');
        return redirect(route('posts.index'));
    }
  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
      
     


  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
      return view('posts.create', ['post' => $post, 'categories' => Category::all(), 'tags' => Tag::all()]);
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id)
    {
        $post=post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
  
       if ($request->hasFile('image')) {
        $image = $request->image->store('images', 'public');
        Storage::disk('public')->delete($post->image);
        $post->image = $image;
        
      }
       
       if ($request->tags)
        {
         $post->tags()->sync($request->tags);
        }
      
     
      $post->update();
      session()->flash('update', 'post updated successfully');
      return redirect(route('posts.index'));
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        if ($post->trashed()) {
            Storage::disk('public')->delete($post->image);
            $post->forceDelete();
            session()->flash('delete', 'post delete successfully');

        } else {
            $post->delete();
            session()->flash('trashed', 'post trashed successfully');
        }
        return redirect(route('posts.index'));
    }
  
    public function trashed() {
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->withPosts($trashed);
    }
  
    public function restore($id) {
      Post::withTrashed()->where('id', $id)->restore();
      session()->flash('restored', 'post restored successfully');
      return redirect(route('posts.index'));
    }
  }
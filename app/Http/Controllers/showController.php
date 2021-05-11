<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\category;
use App\Models\Tag;
use App\Models\User;
use App\Models\comment;
use Illuminate\Support\Facades\Auth;
class showController extends Controller
{
    public function show(  $id)
    {
        $post=post::find($id);  
        $user = $post->user;
        $comments=$post->comment;
        $profile = $user->profile;
        return view("posts.show")->with('post',$post)->with('categories',Category::all())->with('profile',$profile)->with('user',$user)->with('tags',Tag::all())->with('comments',$comments);
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\User;
 use App\Models\Tag;
use App\Models\post;
use App\Models\category;


use Illuminate\Http\Request;

class DashbordController extends Controller
{
    public function index() {
        return view('dashbord.index',[
          'posts_count' => post::all()->count(),
          'users_count' => User::all()->count(),
          'categories_count' => Category::all()->count(),
          'tags_count'=>Tag::all()->count()
        ]);
      }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;

class welcomeController extends Controller
{
    public function index() {
        return view('welcome', [
          'posts' => Post::paginate(3)
        ]);
      }

 }

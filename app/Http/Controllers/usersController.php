<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\profile;
class usersController extends Controller
{
    public function index()
    {
        return view('users.index')->with('users',User::all());
    }

    public function make_admin($id)
    {
        $user=User::find($id);
        $user->role = 'admin';
        $user->update();
         return redirect(route('users.index'));
    }

    public function edit($id)
    {
        $user=User::find($id);
        return view('users.profile')->with('user',$user)->with('profile',$user->profile);
    }
    public function update( $id, Request $request) {
        $user=User::find($id);
        $profile = $user->profile;
        $data = $request->all();
        if ($request->hasFile('picture')) {
          $picture = $request->picture->store('profilesPicture', 'public');
          $data['picture'] = $picture;
        }
        $user->update($data);
        $profile->update($data);
        return redirect(route('home'));
      }
}

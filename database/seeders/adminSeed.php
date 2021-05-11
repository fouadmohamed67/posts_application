<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\profile;
use Illuminate\Support\Facades\DB; 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class adminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->where('email', 'algorithm@gmail.com')->first();

      if (! $user) {
        $newUser= User::create([
          'name' => 'fouad',
          'email' => 'fouadmohamed@laravel',
          'password' => Hash::make('123123'),
          'role' => 'admin'
        ]);
        $profile=profile::create([
          'user_id'=>$newUser->id,
          'picture'=>$newUser->getGravatar()
          ]);
      }
 
    }
}

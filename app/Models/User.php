<?php

namespace App\Models;
use App\Models\profile;
use App\Models\comment;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isAdmin()
    {
        return $this->role =='admin';
    }

    public function getGravatar() {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://gravatar.com/avatar/$hash";
      }


      public function profile() {
        return $this->hasOne(Profile::class);
      }

      public function getPicture() {
        return $this->profile->picture;
      }
  

      public function hasPicture() {
        if (preg_match('/profilesPicture/',$this->profile->picture,$match)) {
          return true;
        } else {
          return false;
        }
      }

      public function posts() {
        return $this->hasMany(Post::class);
      }

      public function comment() {
        return $this->hasMany(comment::class);
      }
}

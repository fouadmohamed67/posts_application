<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','about', 'picture', 'twitter', 'facebook'
      ];
    public function user() {
        return $this->belongsTo(User::class);
      }
}

<?php

namespace App\Models;
use App\Models\category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class post extends Model
{


    use SoftDeletes;
    use HasFactory;

   
      public function category() {
        return $this->belongsTo(Category::class);
      }
      
      public function tags()
      {
        return $this->belongsToMany(Tag::class);
      }

      public function hasTag($tagId) {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
      }

      public function user() {
        return $this->belongsTo(User::class);
      }


      public function comment()
      {
          return $this->hasMany(comment::class);
      }
}

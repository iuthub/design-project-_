<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id','comment_id','authorable_type','authorable_id','content','is_approve'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function authorable()
    {
        return $this->morphTo();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

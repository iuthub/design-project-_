<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name','frequency'];

    public function posts()
    {
        $this->hasMany(Post::class);
    }
}

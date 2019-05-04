<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name','email'];

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'authorable');
    }
}

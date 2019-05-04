<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable =['user_id', 'extension', 'name', 'path'];

    public function getWidthAttribute()
    {
        return getimagesize(asset('storage/images/media/'.$this->path))[0];
    }
    public function getHeightAttribute()
    {
        return getimagesize(asset('storage/images/media/'.$this->path))[1];
    }
}

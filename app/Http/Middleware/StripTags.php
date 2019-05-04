<?php

namespace App\Http\Middleware;

class StripTags extends BaseStripper
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array
     */
    protected $except = [
        'password',
        'password_confirmation',
        'content'
    ];
}

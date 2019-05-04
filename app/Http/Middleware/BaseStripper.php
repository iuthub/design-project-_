<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 8/23/17
 * Time: 2:41 PM
 */

namespace App\Http\Middleware;


use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class BaseStripper extends TransformsRequest
{
    protected $except= [];

    /**
     * Transform the given value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        if (in_array($key, $this->except, true)) {
            return $value;
        }

        return strip_tags($value,'<br>');
    }
}

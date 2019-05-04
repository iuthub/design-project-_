<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 8/29/18
 * Time: 7:34 PM
 */

namespace App\Repositories;


use App\Models\Post;

class PostRepository implements PostInterface
{
    public $model;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function getAll()
    {
        return $this->model->all();
    }
}

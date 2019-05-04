<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 8/29/18
 * Time: 7:34 PM
 */

namespace App\Repositories;


use App\Models\Author;

class AuthorRepository implements AuthorInterface
{
    public $model;

    public function __construct(Author $author)
    {
        $this->model = $author;
    }


    public function firstOrCreate($parameters)
    {
        return $this->model->firstOrCreate(['email' => $parameters['email']], ['name' => $parameters['name']]);
    }


}

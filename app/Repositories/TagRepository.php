<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 8/29/18
 * Time: 7:34 PM
 */

namespace App\Repositories;


use App\Models\Tag;

class TagRepository implements TagInterface
{
    public $model;

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }
    public function getByName($name)
    {
        return $this->model->where('name', $name)->first();
    }

    public function save($parameters)
    {
        return $this->model->create($parameters);
    }

    public function getDropDownList()
    {
        return $this->model->groupBy('name')->pluck('name','name')->toArray();
    }
}

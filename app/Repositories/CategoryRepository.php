<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 8/29/18
 * Time: 7:34 PM
 */

namespace App\Repositories;


use App\Models\Category;

class CategoryRepository implements CategoryInterface
{
    public $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function save($parameters)
    {
        // TODO: Implement save() method.
    }

    public function update($id, $parameters)
    {
        // TODO: Implement update() method.
    }

    public function paginate($itemPerPage=15, $parameters= null)
    {
       return $this->model->paginate($itemPerPage);
    }
}

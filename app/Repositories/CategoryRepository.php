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
        return $this->model->create($parameters);
    }

    public function update($id, $parameters)
    {
        return $this->model->where('id',$id)->update($parameters);
    }

    public function paginate($itemPerPage=15, $parameters= null)
    {
       return $this->model->paginate($itemPerPage);
    }

    public function getListForDropDown()
    {
        return $this->model->pluck('name','id')->toArray();
    }
}

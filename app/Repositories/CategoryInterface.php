<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 8/29/18
 * Time: 7:34 PM
 */

namespace App\Repositories;


interface CategoryInterface
{
    public function getAll();

    public function getById($id);

    public function save($parameters);

    public function update($id, $parameters);
    public function paginate($itemPerPage, $parameters);
}

<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 8/29/18
 * Time: 7:34 PM
 */

namespace App\Repositories;


interface PostInterface
{
    public function getAll();

    public function getById($id);

    public function save($parameters);

    public function update($id, $parameters);

    public function paginate($itemPerPage, $parameters);

    public function getSortingColumns();

    public function getSortingOrders();

    public function getSortingColumnNameByKey($key);

    public function getSortingOrderNameByKey($key);

    public function softDelete($id);

    public function changeState($id);
}

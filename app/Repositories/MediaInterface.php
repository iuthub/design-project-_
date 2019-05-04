<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 9/1/18
 * Time: 11:42 AM
 */

namespace App\Repositories;


interface MediaInterface
{
    public function getById($id);

    public function getAllByUserId($userId, $parameters, $pagination = true);

    public function save($parameters);

    public function update($id, $parameters);

    public function delete($id);

    public function getSortingColumnNameByKey($key);

    public function getSortingOrderNameByKey($key);

    public function getSortingColumns();

    public function getSortingOrders();
}
<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 9/1/18
 * Time: 11:42 AM
 */

namespace App\Repositories;


interface TagInterface
{
    public function getDropDownList();

    public function save($parameters);

    public function getByName($name);
}
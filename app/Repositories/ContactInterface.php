<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 9/20/18
 * Time: 12:00 AM
 */

namespace App\Repositories;


interface ContactInterface
{
    public function save($parameters);

    public function getAll();
}
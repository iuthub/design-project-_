<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 9/1/18
 * Time: 11:42 AM
 */

namespace App\Repositories;


interface SubscriberInterface
{

    public function save($parameters);

    public function optOut($id);

    public function getAllEmails();
}
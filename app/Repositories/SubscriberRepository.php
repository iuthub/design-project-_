<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 8/29/18
 * Time: 7:34 PM
 */

namespace App\Repositories;


use App\Models\Subscriber;

class SubscriberRepository implements SubscriberInterface
{
    public $model;

    public function __construct(Subscriber $subscriber)
    {
        $this->model = $subscriber;
    }

    public function save($parameters)
    {
        return $this->model->create($parameters);
    }


    public function optOut($id)
    {
        return $this->model->where('id', $id)->update(['is_opt_out' => 1]);
    }

    public function getAllEmails()
    {
        return $this->model->where('is_opt_out', 0)->pluck('email')->toArray();
    }
}

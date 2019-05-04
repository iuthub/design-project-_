<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 8/29/18
 * Time: 7:34 PM
 */

namespace App\Repositories;


use App\Models\Contact;

class ContactRepository implements ContactInterface
{
    public $model;

    public function __construct(Contact $contact)
    {
        $this->model = $contact;
    }


    public function save($parameters)
    {
        return $this->model->create($parameters);
    }

    public function getAll()
    {
        return $this->model->all();
    }
}

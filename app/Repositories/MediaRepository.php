<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 8/29/18
 * Time: 7:34 PM
 */

namespace App\Repositories;


use App\Models\Media;

class MediaRepository implements MediaInterface
{
    public $model;
    public $sortingColumns;
    public $sortingOrders;

    public function __construct(Media $media)
    {
        $this->sortingColumns = [
            'id' => __('ID'),
            'name' => __('Name'),
            'created_at' => __('Uploaded Date')
        ];
        $this->sortingOrders = [
            'desc' => __('Descending'),
            'asc' => __('Ascending')
        ];
        $this->model = $media;
    }

    public function getAllByUserId($userId, $parameters, $pagination = true)
    {
        $query = $this->model->select();
        if (!is_null($parameters)) {
            if (isset($parameters['column']) && isset($parameters['order'])) {
                $query = $query->orderBy($this->getSortingColumnNameByKey($parameters['column']), $this->getSortingOrderNameByKey($parameters['order']));
            }
            if (!empty($parameters['search'])) {
                $searchs = explode(' ', $parameters['search']);
                foreach ($searchs as $search) {
                    $query = $query->where(function ($q) use ($search) {
                        $q->where('id', $search)
                            ->orWhere('name', 'LIKE', '%' . $search . '%');
                    });
                }
            }
        }

        $query = $query->where('user_id', $userId)->orderBy('id', 'desc');
        if ($pagination) {
            $itemPerPage = ITEM_PER_PAGE;
            return $query->paginate($itemPerPage);
        }
        return $query->get();
    }

    public function getSortingColumnNameByKey($key)
    {
        $fieldNames = array_keys($this->sortingColumns);
        return $fieldNames[$key] ?: null;
    }

    public function getSortingOrderNameByKey($key)
    {
        $orderNames = array_keys($this->sortingOrders);
        return $orderNames[$key] ?: null;
    }

    public function save($parameters)
    {
        return $this->model->create($parameters);
    }

    public function update($id, $parameters)
    {
        return $this->model->where('id', $id)->update($parameters);
    }

    public function delete($id)
    {
        $medium = $this->getById($id);
        $fileName = $medium->path;
        $medium->delete();
        return $fileName;
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getSortingColumns()
    {
        return array_values($this->sortingColumns);

    }

    public function getSortingOrders()
    {
        return array_values($this->sortingOrders);
    }
}

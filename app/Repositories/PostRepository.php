<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 8/29/18
 * Time: 7:34 PM
 */

namespace App\Repositories;


use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostRepository implements PostInterface
{
    public $model;
    public $sortingColumns;
    public $sortingOrders;

    public function __construct(Post $post)
    {
        $this->sortingColumns = [
            'id' => __('ID'),
            'title' => __('Title'),
            'category' => __('Category'),
            'is_publish' => __('Published')
        ];
        $this->sortingOrders = [
            'desc' => __('Descending'),
            'asc' => __('Ascending')
        ];
        $this->model = $post;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function save($parameters)
    {
        $response = false;
        try {
            DB::transaction(function () use ($parameters, &$response) {
                $tagIds = [];
                if (!empty($parameters['tags'])) {
                    $tags = $parameters['tags'];
                    unset($parameters['tags']);
                    $tagModel = app(TagInterface::class);
                    foreach ($tags as $tag) {
                        $tagData = $tagModel->model->where('name', $tag)->first();
                        if (empty($tagData)) {
                            $input = [
                                'name' => $tag,
                                'frequency' => 1
                            ];
                            $tagData = $tagModel->save($input);
                        }
                        array_push($tagIds, $tagData->id);
                    }
                }
                $post = $this->model->create($parameters);
                if (!empty($tagIds)) {
                    $post->tags()->sync($tagIds);
                }
                $response = true;
            });
        } catch (\Exception $exception) {
            return false;
        }
        return $response;
    }

    public function update($id, $parameters)
    {
        $response = false;
        try {
            DB::transaction(function () use ($id, $parameters, &$response) {
                $post = $this->getById($id);
                $tagIds = [];
                if (!empty($parameters['tags'])) {
                    $tags = $parameters['tags'];
                    unset($parameters['tags']);
                    $tagModel = app(TagInterface::class);
                    foreach ($tags as $tag) {
                        $tagData = $tagModel->getByName($tag);
                        if(empty($tagData)){
                            $input = [
                                'name' => $tag,
                                'frequency' => 1
                            ];
                            $tagData = $tagModel->save($input);
                        }
                        array_push($tagIds, $tagData->id);
                    }
                }
                $this->model->where('id',$id)->update($parameters);
                if (!empty($tagIds)) {
                    $post->tags()->sync($tagIds);
                }
                $response = true;
            });
        } catch (\Exception $exception) {
            return false;
        }
        return $response;
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getRelatedTagNames(Post $post)
    {
        $post->load('tags');
        return $post->tags->pluck('name')->toArray();
    }

    public function paginate($itemPerPage = 15, $parameters = null)
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
                            ->orWhere('title', 'LIKE', '%' . $search . '%');
                    });
                }
            }
        }else {
            $query = $query->orderBy('id', 'desc');
        }
        return $query->with('category', 'tags')->simplePaginate($itemPerPage);
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

    public function getSortingColumns()
    {
        return array_values($this->sortingColumns);

    }

    public function getSortingOrders()
    {
        return array_values($this->sortingOrders);
    }

    public function softDelete($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function changeState($id)
    {
        $post = $this->model->where('id', $id)->first();
        if (!empty($post)) {
            return $post->update(['is_publish' => abs((int)$post->is_publish - 1)]);
        }
        return false;
    }
}

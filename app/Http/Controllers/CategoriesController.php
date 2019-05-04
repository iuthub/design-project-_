<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryInterface;
use App\Services\BreadcrumbService;

class CategoriesController extends Controller
{
    public $category;
    public $breadcrumb;

    public function __construct(CategoryInterface $category, BreadcrumbService $breadcrumb)
    {
        $this->category = $category;
        $this->breadcrumb = $breadcrumb;
    }

    public function index()
    {
        $data['categories'] = $this->category->paginate();
        $data['breadcrumbs'] = $this->breadcrumb->get('admin.dashboard.categories');
        return view('backend.categories.index',$data);
    }

    public function create()
    {
        $data['breadcrumbs'] = $this->breadcrumb->get('admin.dashboard.categories.create');
        return view('backend.categories.create',$data);
    }
}

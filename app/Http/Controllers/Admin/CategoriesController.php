<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
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

    public function store(CategoryRequest $request)
    {
        $input = $request->only(['name']);
        $input['slug'] = str_slug($request->get('name'));
        if($this->category->save($input)){
            return redirect()->route('admin.categories.index')->with('success',__('Category has been created successfully.'));
        }
        return redirect()->back()->withInput()->with('error',__('Category cannot be created.'));
    }

    public function edit($id)
    {
        $data['category'] = $this->category->getById($id);
        $data['breadcrumbs'] = $this->breadcrumb->get('admin.dashboard.categories.edit');
        return view('backend.categories.edit',$data);
    }

    public function update(CategoryRequest $request, $id)
    {
        $input = $request->only(['name']);
        $input['slug'] = str_slug($request->get('name'));
        if($this->category->update($id, $input)){
            return redirect()->route('admin.categories.index')->with('success',__('Category has been updated successfully.'));
        }
        return redirect()->back()->withInput()->with('error',__('Category cannot be updated.'));
    }
}

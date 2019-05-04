<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Repositories\CategoryInterface;
use App\Repositories\PostInterface;
use App\Services\BreadcrumbService;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public $post;
    public $breadcrumb;

    public function __construct(PostInterface $post, BreadcrumbService $breadcrumbService)
    {
        $this->post = $post;
        $this->breadcrumb = $breadcrumbService;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data['columns'] = $this->post->getSortingColumns();
        $data['orders'] = $this->post->getSortingOrders();
        $data['column'] = $request->get('column') ?: null;
        $data['order'] = $request->get('order') ?: null;
        $data['search'] = $request->get('search') ?: null;
        $data['posts'] = $this->post->paginate(ITEM_PER_PAGE, $request->all());
        $data['breadcrumbs'] = $this->breadcrumb->get('admin.dashboard.posts');
        return view('backend.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @param CategoryInterface $category
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryInterface $category)
    {
        $data['categories'] = $category->getListForDropDown();
        $data['breadcrumbs'] = $this->breadcrumb->get('admin.dashboard.posts.create');
        return view('backend.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $input = $request->only(['title', 'category_id', 'content']);
        $input['user_id'] = 1;
        if ($this->post->save($input)) {
            return redirect()->route('admin.posts.index')->with('success', __('Post has been created successfully.'));
        }
        return redirect()->back()->with('error', __('Post cannot be created.'));
    }

    /**
     * Display the specified resource.
     * @param CategoryInterface $category
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryInterface $category, $id)
    {
        $data['breadcrumbs'] = $this->breadcrumb->get('admin.dashboard.posts.show');
        $data['post'] = $this->post->getById($id);
        $data['categories'] = $category->getListForDropDown();
        return view('backend.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param CategoryInterface $category
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(CategoryInterface $category, $id)
    {
        $data['breadcrumbs'] = $this->breadcrumb->get('admin.dashboard.posts.show');
        $data['post'] = $this->post->getById($id);
        $data['categories'] = $category->getListForDropDown();
        return view('backend.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param PostRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, $id)
    {
        $input = $request->only(['title', 'category_id', 'content']);
        $input['is_publish'] = $request->has('is_publish');
        if ($this->post->update($id, $input)) {
            return redirect()->route('admin.posts.index')->with('success', __('Post has been updated successfully.'));
        }
        return redirect()->back()->with('error', __('Post cannot be updated.'));
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->post->softDelete($id)) {
            return redirect()->route('admin.posts.index')->with('success', __('Post has been deleted successfully.'));
        }
        return redirect()->back()->with('error', __('Post cannot be deleted.'));
    }

    public function changeState($id)
    {
        $currentState = request()->segment(4);
        if ($this->post->changeState($id)) {
            return redirect()->route('admin.posts.index')->with('success', __('Post has been :state successfully.',['state'=> $currentState.'ed']));
        }
        return redirect()->back()->with('error', __('Post cannot be :state.',['state'=> $currentState.'ed']));
    }
}

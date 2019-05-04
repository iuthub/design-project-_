<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediaRequest;
use App\Repositories\MediaInterface;
use App\Services\BreadcrumbService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MediaController extends Controller
{
    public $mediaRepository;
    public $breadcrumb;

    public function __construct(MediaInterface $media, BreadcrumbService $breadcrumbService)
    {
        $this->mediaRepository = $media;
        $this->breadcrumb = $breadcrumbService;
    }

    public function index(Request $request)
    {
        $data['columns'] = $this->mediaRepository->getSortingColumns();
        $data['orders'] = $this->mediaRepository->getSortingOrders();
        $data['column'] = $request->get('column') ?: null;
        $data['order'] = $request->get('order') ?: null;
        $data['search'] = $request->get('search') ?: null;
        $userId = Auth::id();
        $data['media'] = $this->mediaRepository->getAllByUserId($userId, $request->all());
        $data['breadcrumbs'] = $this->breadcrumb->get('admin.dashboard.media');
        return view('backend.media.index', $data);

    }

    public function create()
    {
        $data['breadcrumbs'] = $this->breadcrumb->get('admin.dashboard.media');
        return view('backend.media.create', $data);
    }

    public function store(MediaRequest $request)
    {
        if ($request->hasFile('file')) {
            $name = time();
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileName = $name . '.' . $extension;
            if ($request->file('file')->storeAs('images/media', $fileName)) {
                $input['path'] = $fileName;
                $input['extension'] = $extension;
            } else {
                return redirect()->back()->with('error', __('Failed to upload image.'));
            }
        }

        $input['user_id'] = $request->user()->id;
        $input['name'] = $request->get('name', $name);

        if ($medium = $this->mediaRepository->save($input)) {
            return redirect()->route('admin.media.edit', $medium->id)->with('success', __('Media has been uploaded successfully.'));
        }
        return back()->withInput()->with('error', __('Failed to upload media.'));
    }

    public function edit($id)
    {
        $data['medium'] = $this->mediaRepository->getById($id);
        $data['breadcrumbs'] = $this->breadcrumb->get('admin.dashboard.media');
        return view('backend.media.edit', $data);
    }

    public function update(MediaRequest $request, $id)
    {
        $medium = $this->mediaRepository->getById($id);
        $imageFullPath = asset('storage/images/media/' . $medium->path);
        list($width, $height) = getimagesize($imageFullPath);
        $img = Image::make($imageFullPath);

        if ($request->has('save_as_new')) {
            $name = time();
            $extension = $medium->extension;
            $fileName = $name . '.' . $extension;

            if ($request->x || $request->y) {
                $img->crop($request->width, $request->height, $request->x, $request->y);
            } else {
                $img->fit($request->width, $request->height);
            }
            $newImage = $img->save(storage_path('app/public/images/media/' . $fileName), 100);
            $input['user_id'] = Auth::id();
            $input['path'] = $newImage->basename;
            $input['extension'] = $newImage->extension;
            $input['extension'] = $newImage->extension;
            if ($medium = $this->mediaRepository->save($input)) {
                return redirect()->route('admin.media.edit', $medium->id)->with('success', __('Media has been created successfully.'));
            }
        } else {
            if ($request->width != $width || $request->height != $height) {
                if ($request->x || $request->y) {
                    $img->crop($request->width, $request->height, $request->x, $request->y);
                } else {
                    $img->fit($request->width, $request->height);
                }
                $img->save(storage_path('app/public/images/media/' . $medium->path), 100);
                $input['name'] = $request->name;
                if ($this->mediaRepository->update($medium->id, $input)) {
                    return redirect()->route('admin.media.edit', $medium->id)->with('success', 'Media has been updated successfully.');
                }
            }
        }
        return redirect()->back()->with('error', 'Failed to update media.');
    }


    public function destroy($id)
    {
        if ($fileName = $this->mediaRepository->delete($id)) {
            Storage::delete('images/media/' . $fileName);
            return redirect()->route('admin.media.index')->with('success', 'Media has been deleted successfully.');
        }
        return redirect()->back()->with('error', 'Failed to delete media.');
    }

    public function download(Request $request, $id)
    {
        $medium = $this->mediaRepository->getById($id);
        if (empty($medium)) {
            return redirect()->back()->with('error', __('Invalid media ID.'));
        }

        return response()->download('storage/images/media/' . $medium->path);
    }
}

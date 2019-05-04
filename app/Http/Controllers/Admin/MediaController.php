<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Repositories\MediaInterface;
use App\Services\BreadcrumbService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('backend.media.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()) {                                     //Authentication for unlogged users
            return redirect()->route('adminlogin');
        } else {
            if (Auth::user()->role >= 10) {
                // code goes here.
                $file = $request->file('file');

                $filepath = path_images();
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $extension = $file->getClientOriginalExtension();
                $userid = Auth::user()->id;

                $fileuploaded = $file->move(path_images(), $filename);
                if ($fileuploaded) {
                    $img = Image::make($filepath . $filename);
                    $img->fit(160);
                    $img->crop(120, 120, 20, 20);
                    $img->save(path_thumbs() . $filename);

                    $input = array(
                        'filepath' => $filepath,
                        'filename' => $filename,
                        'extension' => $extension,
                        'user_id' => $userid
                    );

                    $inserted = Media::create($input);
                    return $inserted;
                }
            } else {                                               //Authentication for User Less than managers
                return redirect()->route('dashboard');
            }
        }
    }



    public function destroy($id)
    {
        if (!Auth::user()) {                                     //Authentication for unlogged users
            return redirect()->route('adminlogin');
        } else {
            if (Auth::user()->role >= 10) {
                // code goes here.
                $media = Media::where('id', $id)->first();
                if ($media) {
                    File::delete($media->filepath . $media->filename, $media->filepath . 'thumbs/' . $media->filename);
                    $delete = Media::where('id', $id)->delete();
                    if ($delete) {
                        return redirect()->back()->with(['success' => 'The media item Has Been Deleted Successfully']);
                    } else {
                        return redirect()->back()->with(['dissmiss' => 'The media item can not Be Deleted for some reason']);
                    }
                } else {
                    return redirect()->back()->with(['dissmiss' => 'There is no such item to delete']);
                }
            } else {                                               //Authentication for User Less than managers
                return redirect()->route('dashboard');
            }
        }
    }

    public function download(Request $request, $id)
    {
        $medium = $this->mediaRepository->getById($id);
        if(empty($medium)){
            return redirect()->back()->with('error',__('Invalid media ID.'));
        }

        return response()->download('storage/images/media/'.$medium->path);
    }
}

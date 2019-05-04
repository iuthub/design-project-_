<?php

namespace App\Http\Controllers;

use App\Repositories\PostInterface;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param PostInterface $post
     * @return \Illuminate\Http\Response
     */
    public function index(PostInterface $post)
    {
        $data['posts'] = $post->paginate();
        return view('frontend.blog', $data);
    }
}

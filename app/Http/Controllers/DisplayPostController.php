<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Repositories\PostInterface;
use Illuminate\Http\Request;

class DisplayPostController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param PostInterface $post
     * @param $id
     * @return void
     */
    public function __invoke(PostInterface $post, $id)
    {
        $data['post'] = $post->getById($id);
        $data['post']->load(['comments'=> function($q){
            $q->whereNull('comment_id');
        },'comments.authorable','comments.comments.authorable']);
        return view('frontend.post', $data);
    }
}

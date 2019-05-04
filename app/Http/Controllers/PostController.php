<?php

namespace App\Http\Controllers;

use App\Repositories\CommentInterface;
use App\Repositories\PostInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param PostInterface $post
     * @param $id
     * @return void
     */
    public function show(PostInterface $post, $id)
    {
        $data['post'] = $post->getById($id);
        $data['post']->load(['comments' => function ($q) {
            $q->whereNull('comment_id');
        }, 'comments.authorable', 'comments.comments.authorable']);
        return view('frontend.post', $data);
    }

    public function comment(Request $request, CommentInterface $comment, $id)
    {
        $this->validate($request,[
           'name' => 'required',
           'email' => 'required|email',
           'content' => 'required',
        ]);
        $comment->save($id, $request->only('name','email','content','comment_id'));
        return redirect()->back();
    }
}

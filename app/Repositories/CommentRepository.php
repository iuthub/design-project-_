<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 8/29/18
 * Time: 7:34 PM
 */

namespace App\Repositories;


use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CommentInterface
{
    public $model;

    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

    public function save($postId, $parameters)
    {
        if (Auth::check()) {
            $authorId = Auth::id();
            $type = 'App\Models\User';
        } else {
            $author = app(AuthorInterface::class)->firstOrCreate($parameters);
            $authorId = $author->id;
            $type = 'App\Models\Author';
        }
        $inputs = [
            'post_id' => $postId,
            'comment_id' => $parameters['comment_id'],
            'authorable_type' => $type,
            'authorable_id' => $authorId,
            'content' => $parameters['content']
        ];
        return Comment::create($inputs);
    }


}

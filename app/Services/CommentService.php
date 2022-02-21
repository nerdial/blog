<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class CommentService
{

    public function getCommentsByPostId($postId): Collection
    {
        return Comment::where('post_id', $postId)->latest('id')->get();
    }

    public function save(array $data): Comment
    {
        return Comment::create($data);
    }

}

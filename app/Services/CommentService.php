<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class CommentService
{

    public function getCommentsByPostId($postId): Collection
    {
        return Comment::latest()->where('post_id' , $postId)->get();
    }

}

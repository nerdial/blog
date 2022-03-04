<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository
{

    public function getCommentsByPostId(string $postId): Collection
    {
        return Comment::where([
            'post_id' => $postId

        ])->latest('id')->get()->toTree();
    }

    public function saveRoot(array $data): Comment
    {
        return Comment::create($data);
    }

    public function saveNode(string $parentId, array $data): Comment
    {
        $parent = Comment::find($parentId);
        $newComment = Comment::create($data);
        $parent->prependNode($newComment);
        return $newComment;
    }
}

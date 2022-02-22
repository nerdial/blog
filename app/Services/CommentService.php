<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class CommentService
{

    public function getCommentsByPostId($postId): Collection
    {
        return Comment::where([
            'post_id'=> $postId

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

    public function prepareData(array $data): array
    {
        $data['name'] = strip_tags($data['name']);
        $data['body'] = strip_tags($data['body']);
        return $data;
    }

}

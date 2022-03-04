<?php

namespace App\Services;


use App\Models\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Database\Eloquent\Collection;

class CommentService
{

    public function __construct(private CommentRepository $repository)
    {
    }

    public function getCommentsByPost($postId): Collection
    {
        return $this->repository->getCommentsByPostId($postId);
    }

    public function createComment(array $data, string $parentId = null): Comment
    {
        return (isset($parentId))
            ? $this->repository->saveNode($parentId, $data)
            : $this->repository->saveRoot($data);
    }

    public function prepareData(array $data): array
    {
        $data['name'] = strip_tags($data['name']);
        $data['body'] = strip_tags($data['body']);
        return $data;
    }

}

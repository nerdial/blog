<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Services\CommentService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentController extends Controller
{

    private CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index(string $postId) :ResourceCollection
    {
        $comments = $this->commentService->getCommentsByPostId($postId);
        return CommentResource::collection($comments);
    }

    public function create(string $postId, CommentRequest $request) :CommentResource
    {
        $data = $request->validated() + ['post_id' => $postId];
        $comment = $this->commentService->save($data);

        return new CommentResource($comment);
    }

}

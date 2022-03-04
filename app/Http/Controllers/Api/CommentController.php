<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Services\CommentService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentController extends Controller
{

    public function __construct(private CommentService $commentService)
    {
    }

    public function index(string $postId): ResourceCollection
    {
        $comments = $this->commentService->getCommentsByPost($postId);
        return CommentResource::collection($comments);
    }

    public function create(string $postId, CommentRequest $request): CommentResource
    {
        $requestData = $request->validated() + ['post_id' => $postId];
        $data = $this->commentService->prepareData($requestData);
        $comment = $this->commentService
            ->createComment($data, $request->get('parent_id'));

        return new CommentResource($comment);
    }

}

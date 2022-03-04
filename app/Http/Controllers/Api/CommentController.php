<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Repositories\CommentRepository;
use App\Services\CommentService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentController extends Controller
{

    public function __construct(
        private CommentService    $commentService,
        private CommentRepository $commentRepository
    )
    {
    }

    public function index(string $postId): ResourceCollection
    {
        $comments = $this->commentRepository->getCommentsByPostId($postId);
        return CommentResource::collection($comments);
    }

    public function create(string $postId, CommentRequest $request): CommentResource
    {
        $requestData = $request->validated() + ['post_id' => $postId];
        $data = $this->commentService->prepareData($requestData);

        if ($request->has('parent_id')) {
            $comment = $this->commentRepository->saveNode($request->get('parent_id'), $data);
        } else {
            $comment = $this->commentRepository->saveRoot($data);
        }

        return new CommentResource($comment);
    }

}

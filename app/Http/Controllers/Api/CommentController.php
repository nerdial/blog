<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Services\CommentService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentController extends Controller
{

    public function index(string $postId,CommentService $commentService) :ResourceCollection
    {
        $comments = $commentService->getCommentsByPostId($postId);
        return CommentResource::collection($comments);
    }

}

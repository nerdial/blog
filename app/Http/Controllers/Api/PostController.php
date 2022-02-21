<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Services\BlogService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($id,BlogService $blogService) :PostResource
    {

        $post = $blogService->getPostById($id);
        return new PostResource($post);
    }
}

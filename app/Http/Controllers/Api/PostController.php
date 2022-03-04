<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Repositories\BlogRepository;
use App\Services\BlogService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($id,BlogRepository $blogRepository) :PostResource
    {
        $post = $blogRepository->getPostById($id);
        return new PostResource($post);
    }
}

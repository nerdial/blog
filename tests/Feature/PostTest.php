<?php

namespace Tests\Feature;

use App\Repositories\BlogRepository;
use App\Services\BlogService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_single_post_api()
    {
        $postId = 1;
        $route = route('api.post.show', [$postId]);
        $post = (new BlogRepository())->getPostById($postId);
        $response = $this->get($route);
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => ['id', 'title', 'body']
            ])
            ->assertJsonCount(3, 'data')
            ->assertJson([
                'data' => $post
            ]);
    }
}

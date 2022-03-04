<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentServiceTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_comment_with_service()
    {

        $newComment = Comment::factory()->make()->toArray();

        $commentService = $this->app->make(CommentService::class);

        $comment = $commentService->createComment($newComment);

        $this->assertEquals(Comment::count(), 1);

        $this->assertInstanceOf(Comment::class, $comment);

        $this->assertDatabaseHas(Comment::class, $newComment);

    }

    public function test_create_comment_with_parent()
    {

        $parentComment = Comment::factory()->create();
        $newComment = Comment::factory()->make()->toArray();

        $commentService = $this->app->make(CommentService::class);

        $comment = $commentService->createComment($newComment, $parentComment->id);

        $this->assertEquals(Comment::count(), 2);

        $this->assertInstanceOf(Comment::class, $comment);

        $this->assertDatabaseHas(Comment::class,
            $newComment + [
                'parent_id' => $parentComment->id
            ]);

    }
}

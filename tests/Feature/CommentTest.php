<?php

namespace Tests\Feature;

use App\Models\Comment;
use Database\Seeders\CommentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{

    use RefreshDatabase;

    protected int $postId = 1;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(CommentSeeder::class);

    }

    public function test_get_all_comments_by_post_id()
    {

        $route = route('api.comments.index', [
            'postId' => $this->postId
        ]);
        $comments = Comment::where('post_id', $this->postId)->latest('id')->get();

        $lastCommentId = $comments->first()->id;
        $commentCounted = $comments->count();
        $response = $this->get($route);

        $response->assertStatus(200)->assertJsonStructure([
            'data' => [
                '*' => [
                    'id', 'name', 'body', 'post_id'
                ]
            ]
        ])->assertJsonCount($commentCounted, 'data');

        $jsonData = $response->json('data');
        $firstItemId = $jsonData[0]['id'];

        // making sure we are getting the latest comments
        $this->assertEquals($firstItemId, $lastCommentId);

    }

    public function test_create_new_comment()
    {
        $comment = Comment::factory()->make()->toArray();

        $route = route('api.comments.create', [
            'postId' => $this->postId
        ]);
        $this->json('POST', $route, $comment)
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id', 'name', 'body', 'post_id', 'parent_id'
                ]
            ])->assertJson([
                'data' => $comment
            ]);

        $this->assertDatabaseHas(Comment::class, $comment);

    }

    public function test_create_new_comment_with_parent_id()
    {
        $parentComment = Comment::factory()->create();

        $comment = Comment::factory()->make([
            'parent_id' => $parentComment->id
        ])->toArray();

        $route = route('api.comments.create', [
            'postId' => $this->postId
        ]);
        $response = $this->json('POST', $route, $comment)
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id', 'name', 'body', 'post_id', 'parent_id'
                ]
            ])->assertJson([
                'data' => $comment
            ]);

        $this->assertDatabaseHas(Comment::class, $comment);

    }

    public function test_create_new_comment_with_wrong_data()
    {
        $comment = Comment::factory()->make([
            'name' => null,
            'body' => null
        ])->toArray();

        $route = route('api.comments.create', [
            'postId' => $this->postId
        ]);
        $this->json('POST', $route, $comment)->assertJsonValidationErrors([
            'name', 'body'
        ]);
        $this->assertDatabaseMissing(Comment::class, $comment);
    }
}

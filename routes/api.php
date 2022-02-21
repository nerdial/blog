<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\PostController;
use \App\Http\Controllers\Api\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('post')->group(function () {
    Route::controller(PostController::class)->group(function () {
        Route::get('{id}', 'show')->name('api.post.show')->whereNumber('id');
    });

    Route::controller(CommentController::class)->group(function () {
        Route::get('{postId}/comments', 'index')->name('api.comments.index')
            ->whereNumber('postId');
        Route::post('{postId}/comments', 'index')->name('api.comments.create')
            ->whereNumber('postId');;
    });

});




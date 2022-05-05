<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/**
 * Websites section
 */
Route::get('websites', [WebsiteController::class, 'index']); //get all websites
Route::post('websites/{website}/posts', [WebsiteController::class, 'createPost']); // create a post for website
Route::post('websites/{website}/subscribe', [WebsiteController::class, 'subscribe']); //
Route::put('websites/{website}/unsubscribe', [WebsiteController::class, 'unsubscribe']); //


/**
 * Posts section
 */
Route::get('posts', [PostController::class,'index']); //get all posts
Route::get('posts/preview', [PostController::class, 'previewIndex']); //get all websites
Route::get('posts/{post:id}', [PostController::class, 'show']); // get a post
Route::put('posts/{post:id}/publish', [PostController::class, 'publish']); // publish a post





Route::fallback(function () {
    return response()->json([
        'message' => 'The called API is not found!'], 404);
});

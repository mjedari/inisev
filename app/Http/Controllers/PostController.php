<?php

namespace App\Http\Controllers;

use App\Events\PostPublished;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::published()->get();
    }

    public function previewIndex()
    {
        return Post::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }

    public function publish(Post $post)
    {
        $status = $post->publish();

        if ($status) {
            PostPublished::dispatch($post);
            return response()->json(["message" => "Post published and emails Sent successfully!"]);
        }

        return response()->json(["message" => "No new subscribers to send email!"]);
    }
}

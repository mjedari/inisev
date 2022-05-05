<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Models\User;
use App\Models\Website;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Website::with('subscribers')->get();
    }

    public function subscribe(Website $website, SubscribeRequest $request)
    {
        $user = User::find($request->user_id);
        if ($user->hadSubscribed($website)) {
            return response()->json(["message" => "You already is subscribed on this website!"]);
        }

        try {
            $website->subscribe($user);
            return response()->json(["message" => "You successfully subscribed on this website!"]);
        } catch (Exception $e) {
            return response()->json(["message" => "Sth went wrong!"]);
        }
    }

    public function createPost(Website $website, Request $request)
    {
        $post = $request->only(['title', 'body']);
        return $website->posts()->create($post);
    }

    public function unsubscribe(Website $website)
    {
        //
    }
}

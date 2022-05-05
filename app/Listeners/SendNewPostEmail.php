<?php

namespace App\Listeners;

use App\Events\PostPublished;
use App\Mail\PostPublishedEmail;
use App\Models\User;
use App\Notifications\NewPostNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class SendNewPostEmail
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PostPublished $event)
    {
        $post = $event->post;

        $subscribers = $post->website->subscribers;

        $notNotifiedSubscribers = $post->notifiers;
        //diff subscribers
        $receivers = $subscribers->diff($notNotifiedSubscribers);

        Notification::send($receivers, new NewPostNotification($post));
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Website;
use App\Notifications\NewPostNotification;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendNewPostsEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribers:send {post}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command sends websites new posts to their subscribers.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $postId = $this->argument('post');
        $post = Post::find($postId);

        $subscribers = $post->website->subscribers;

        $notNotifiedSubscribers = $post->notifiers;

        //diff subscribers
        $receivers = $subscribers->diff($notNotifiedSubscribers);

        if ($receivers->isEmpty()) {
            $this->line("No new subscribers found!");
            return $this->terminate();
        }

        try {
            Notification::send($receivers, new NewPostNotification($post));
            $this->info('Emails are scheduled to be sent!');
        } catch (Exception $e) {
            $this->info('Sth went wrong!');
        }

        return $this->terminate();
    }

    protected function terminate()
    {
        $this->newLine(2);
        return 0;
    }
}

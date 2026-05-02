<?php

namespace App\Listeners;

use App\Events\CommentPublished;
use App\Mail\NewCommentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCommentPublishNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CommentPublished $event): void
    {
        $comment = $event->comment;
        Mail::to($comment->post->user->email)
            ->later(now()->addSeconds(1), new NewCommentCreated($comment));
    }
}

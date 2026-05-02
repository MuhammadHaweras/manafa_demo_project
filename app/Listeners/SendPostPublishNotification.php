<?php

namespace App\Listeners;

use App\Events\PostPublished;
use App\Mail\NewPostCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPostPublishNotification implements ShouldQueue
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
    public function handle(PostPublished $event): void
    {
        User::all()->each(function (User $user, int $index) use ($event) {
            Mail::to($user->email)->later(now()->addSeconds($index) , new NewPostCreated($event->post));
        });
    }
}

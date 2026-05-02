<?php

namespace App\Providers;

use App\Events\CommentPublished;
use App\Events\PostPublished;
use App\Events\ReplyPublished;
use App\Listeners\SendCommentPublishNotification;
use App\Listeners\SendPostPublishNotification;
use App\Listeners\SendReplyPublishNotification;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate::define("update-post", function (User $user, Post $post) {
        //     return ($user->id === $post->user_id) || $user->is_admin;
        // });
        // Gate::define("delete-post", function (User $user, Post $post) {
        //     return ($user->id === $post->user_id) || $user->is_admin;
        // });

        // Gate::define("update-comment", function (User $user, Comment $comment) {
        //     return ($user->id === $comment->user_id);
        // });

        // Gate::define("delete-comment", function (User $user, Comment $comment) {
        //     return ($user->id === $comment->user_id  || $user->id === $comment->parent?->user_id) || $user->is_admin;
        // });

        Gate::policy(Post::class, PostPolicy::class);
        Gate::policy(Comment::class, CommentPolicy::class);

        Event::listen(PostPublished::class, SendPostPublishNotification::class);
        Event::listen(CommentPublished::class, SendCommentPublishNotification::class);
        Event::listen(ReplyPublished::class, SendReplyPublishNotification::class);
    }
}

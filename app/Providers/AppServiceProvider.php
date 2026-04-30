<?php

namespace App\Providers;

use App\Models\Comment as ModelsComment;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;
use Dom\Comment as DomComment;
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
    }
}

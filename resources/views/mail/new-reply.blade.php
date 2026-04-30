<x-mail::message>
    # New Reply on your comment

    {{ $comment->user->name }} replied to your comment: {{ $comment->parent->body }}

    <x-mail::button :url="route('posts.show', $comment->post->id)">
        View Reply
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
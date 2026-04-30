<x-mail::message>
    # New Comment

    {{ $comment->user->name }} Commented on Your Post {{ $comment->post->title }}.

    <x-mail::button :url="route('posts.show', $comment->post->id)">
        View Comment
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
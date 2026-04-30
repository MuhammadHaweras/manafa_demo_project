<x-mail::message>
    # New Post Added

    Check out the New Post: {{ $post->title  }} by {{ $post->user->name }}

    <x-mail::button :url="route('posts.show', $post)" color="primary">
        View Post
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
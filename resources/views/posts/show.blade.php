<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white border-b border-gray-200 space-y-6">
        <div>
            <h2 class="text-xl font-bold">{{ $post->title }}</h2>
            <p class="mt-2 text-gray-700">{{ $post->text }}</p>
        </div>
        <section>
            <h3 class="text-lg font-semibold text-black px-3 py-1 inline-block rounded">
                All Comments
            </h3>
            <hr>

            @if ($post->topLevelComments->isEmpty())
                <p class="mt-4 text-gray-500">No comments yet.</p>
            @else
                <ul class="mt-4 space-y-6">
                    @foreach ($post->topLevelComments as $comment)
                        <li class="border rounded-lg p-4 space-y-2">
                            <p class="text-gray-800">{{ $comment->body }}</p>
                            <p class="text-sm text-gray-500">
                                {{ $comment->user->name }} &middot; {{ $comment->created_at->diffForHumans() }}
                            </p>
                            @can('update-comment', $comment)
                                <a href="{{ route('comments.edit', $comment) }}" class="text-blue-500 hover:underline">
                                    Edit Comment
                                </a>
                            @endcan

                            @can('delete-comment', $comment)
                                <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endcan


                            @if ($comment->replies->isNotEmpty())
                                <ul class="ml-6 mt-3 space-y-3 border-l-2 border-gray-200 pl-4">
                                    @foreach ($comment->replies as $reply)
                                        <li>
                                            <p class="text-gray-800">{{ $reply->body }}</p>
                                            <p class="text-sm text-gray-500">
                                                {{ $reply->user->name }} &middot; {{ $reply->created_at->diffForHumans() }}
                                            </p>
                                            @can('update-comment', $reply)
                                                <a href="{{ route('comments.edit_reply', $reply) }}" class="text-blue-500 hover:underline">
                                                    Edit Reply
                                                </a>
                                            @endcan
                                            @can('delete-comment', $reply)
                                                <form method="POST" action="{{ route('comments.destroy', $reply) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            @endcan


                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <form action="{{ route('comments.store') }}" method="POST" class="mt-3">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                <textarea name="body" rows="2" placeholder="Reply to {{ $comment->user->name }}..."
                                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring"></textarea>
                                <button type="submit"
                                    class="mt-1 bg-yellow-300 hover:bg-yellow-400 text-black px-4 py-1.5 rounded-lg text-sm transition">
                                    Reply
                                </button>
                            </form>

                        </li>
                    @endforeach
                </ul>
            @endif
        </section>


        <section>
            <h3 class="text-3xl font-semibold  px-3 py-1 inline-block rounded">
                Add a Comment
            </h3>

            @if (session('success'))
                <p class="mt-2 text-green-600 text-sm">{{ session('success') }}</p>
            @endif

            <form action="{{ route('comments.store') }}" method="POST" class="mt-3 space-y-3">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="hidden" name="parent_id" value="">
                <textarea name="body" rows="3" placeholder="Write a comment..."
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring"></textarea>
                @error('body')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    Submit
                </button>
            </form>
        </section>

    </div>
</x-app-layout>
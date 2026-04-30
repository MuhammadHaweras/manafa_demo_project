<x-app-layout>
    <h1 class="text-3xl text-bold m-4">Top Level Comments</h1>
    <hr>
    <table class="table-auto min-w-full border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
            <tr>
                <th class="px-6 py-3 text-left">ID</th>
                <th class="px-6 py-3 text-left">Comment</th>
                <th class="px-6 py-3 text-left">On Post</th>
                <th class="px-6 py-3 text-left">Comment By</th>
                <th class="px-6 py-3 text-left">Created At</th>
                <th class="px-6 py-3 text-left">Action</th>

            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($comments as $comment)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $comment->id }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $comment->body }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $comment->post->title }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $comment->user->email }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $comment->created_at->diffForHumans() }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">
                        <div class="flex justify-center space-x-3">
                            <form method="POST" action="{{ route('admin.comments.delete', $comment) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('Are you sure?')"
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>
    <h1 class="m-4 text-3xl text-bold">Replies</h1>
    <table class="table-auto min-w-full border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
            <tr>
                <th class="px-6 py-3 text-left">ID</th>
                <th class="px-6 py-3 text-left">Comment</th>
                <th class="px-6 py-3 text-left">Reply to Comment</th>
                <th class="px-6 py-3 text-left">On Post</th>
                <th class="px-6 py-3 text-left">Replied By</th>
                <th class="px-6 py-3 text-left">Created At</th>
                <th class="px-6 py-3 text-left">Action</th>

            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($replies as $reply)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $reply->id }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $reply->body }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $reply->parent->body }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $reply->post->title }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $reply->user->email }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $reply->created_at->diffForHumans() }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">
                        <div class="flex justify-center space-x-3">
                            <form method="POST" action="{{ route('admin.comments.delete', $reply) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('Are you sure?')"
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


</x-app-layout>
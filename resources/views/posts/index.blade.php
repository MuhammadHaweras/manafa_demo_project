<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white border-b border-gray-200">

        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-semibold text-gray-800">All Posts</h3>
            <a href="{{ route('posts.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                + Add New Post
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">

                <!-- Table Head -->
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Text</th>
                        <th class="px-6 py-3 text-left">Author</th>
                        <th class="px-6 py-3 text-left">Category</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="divide-y divide-gray-200">
                    @foreach($posts as $post)
                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-6 py-4 font-medium text-gray-800">
                                <a href="{{route('posts.show', $post)}}"> {{ $post->title }} </a>
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ Str::limit($post->text, 10) }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $post->user->name}}
                            </td>

                            <td class="px-6 py-4">
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                    {{ $post->category->name }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-center space-x-3">
                                    @can('update', $post)
                                        <a href="{{ route('posts.edit', $post) }}"
                                            class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                                            Edit
                                        </a>
                                    @endcan
                                    @can('delete', $post)
                                        <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" onclick="return confirm('Are you sure?')"
                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan


                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
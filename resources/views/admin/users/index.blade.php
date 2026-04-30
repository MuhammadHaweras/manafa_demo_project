<x-app-layout>
    <table class="table-auto min-w-full border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
            <tr>
                <th class="px-6 py-3 text-left">Name</th>
                <th class="px-6 py-3 text-left">Email</th>
                <th class="px-6 py-3 text-left">Created At</th>
                <th class="px-6 py-3 text-left">Action</th>

            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($users as $user)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $user->name }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $user->email }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $user->created_at->diffForHumans() }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">
                        <div class="flex justify-center space-x-3">
                            @if (auth()->id() != $user->id)
                                <form method="POST" action="{{ route('admin.user.delete', $user) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                        Delete
                                    </button>
                                </form>
                            @endif


                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
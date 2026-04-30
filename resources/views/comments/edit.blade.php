<form action="{{ route('comments.update', $comment) }}" method="POST" class="mt-3">
    @csrf
    @method('PUT')
    <textarea name="body" rows="2" placeholder="Edit {{ $comment->body }}..."
        class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring"></textarea>
    <button type="submit"
        class="mt-1 bg-yellow-300 hover:bg-yellow-400 text-black px-4 py-1.5 rounded-lg text-sm transition">
        Edit Comment
    </button>
</form>
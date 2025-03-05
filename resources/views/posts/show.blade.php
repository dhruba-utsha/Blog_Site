<x-layout>
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>
    
        <div class="mb-4">
            <span class="text-gray-600 font-semibold">Categories:</span>
            @foreach ($post->categories as $category)
                <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm mr-2">{{ $category->name }}</span>
            @endforeach
        </div>
    
        <div class="mb-4">
            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full h-64 object-cover rounded-lg">
        </div>
    
        <p class="text-gray-700 text-lg leading-relaxed">{{ $post->content }}</p>

        <div class="flex justify-between items-center">
            <div class="mt-4 flex items-center space-x-3">
                <button onclick="toggleLike({{ $post->id }})" id="like-btn-{{ $post->id }}"
                    class="cursor-pointer px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition">
                    <span id="like-icon-{{ $post->id }}">
                        @if($post->isLikedByUser())
                            ❤️
                        @else
                            🤍
                        @endif
                    </span>
                    <span id="like-count-{{ $post->id }}">{{ $post->likes->count() }}</span>
                </button>
            </div>

            <div class="flex gap-4 mt-6">
                <button>
                    <a href="{{ route('posts.index') }}" class="inline-block bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600">
                        Back to Posts
                    </a>
                </button>

                {{-- @if (auth()->id() === $post->user_id) --}}
                <button>
                    <a href="{{ route('post.edit',  $post->id) }}" class="inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                        Edit Post
                    </a>
                </button>

                <form method="POST" action="{{route('post.delete', $post->id)}}">
                    @csrf
                    @method('delete')
                    <button type="submit"
                        class="cursor-pointer px-4 py-2 bg-red-500 text-white rounded-lg shadow-md hover:bg-red-600 transition w-full">
                        Delete Post
                    </button>
                </form>
            </div>
        </div>

        <div>
            <form method="POST"  action="{{ route('comment.store', $post->id) }}" class="mt-6">
                @csrf
                <div class="mb-2">
                    <label for="body" class="block text-gray-700 font-semibold mb-2">Add a Comment</label>
                    <textarea name="body" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Write your comment here"></textarea>
                </div>
                
                <div class="mb-6">
                    <button type="submit" class="cursor-pointer px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                        Comment
                    </button>
                </div>
            </form>
        </div>
        <div>
            <h3 class="text-2xl font-semibold mt-6">All Comments</h3>
            <div class="mt-4">
                @foreach ($post->comments as $comment)
                    <div class="border-b p-4 bg-blue-200 rounded-lg mb-4">
                        <p class="text-gray-800 text-xl font-semibold">
                            <strong>{{ $comment->user->name }}</strong>
                            <span class="text-sm text-gray-600 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                        </p>
                        <p class="mt-2 text-gray-700">{{ $comment->body }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>

<script>
    function toggleLike(postId) {
        fetch(`/posts/${postId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            let likeBtn = document.getElementById(`like-btn-${postId}`);
            let likeIcon = document.getElementById(`like-icon-${postId}`);
            let likeCount = document.getElementById(`like-count-${postId}`);

            likeIcon.innerHTML = data.liked ? '❤️' : '🤍';
            likeCount.innerHTML = data.likeCount;
        })
        .catch(error => console.error('Error:', error));
    }
</script>

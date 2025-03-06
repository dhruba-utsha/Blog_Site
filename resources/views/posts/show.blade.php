<x-layout>
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
        <div class="text-blue-500 text-lg font-bold flex justify-between mb-4">
            <p>Written By: {{ $post->user->name }}</p> 
            <p>{{ $post->created_at->format('F j, Y, g:i a') }}</p>
        </div>

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

                @if(auth()->user()->role === 'admin' || (auth()->user()->role === 'author' && auth()->user()->id === $post->user_id))
                    <button>
                        <a href="{{ route('post.edit',  $post->id) }}" class="inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                            Edit Post
                        </a>
                    </button>

                    <div>
                        <button type="button" class="cursor-pointer px-4 py-2 bg-red-500 text-white rounded-lg shadow-md hover:bg-red-600 transition w-full delete-item" 
                            data-type="post" data-id="{{ $post->id }}">
                            Delete Post
                        </button>

                        <form id="delete-form-post-{{ $post->id }}" action="{{ route('post.delete', $post->id) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                @endif
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
                    <button id="comment-btn" type="submit" class="cursor-pointer px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                        Comment
                    </button>
                </div>
            </form>
        </div>
        
        <div>
            <h3 class="text-2xl font-semibold mt-6">All Comments <span class="text-orange-600">({{ $post->comments->count() }})</span></h3>
            <div class="mt-4">
                @foreach ($post->comments as $comment)
                    <div class="flex justify-between border-b bg-blue-200 p-4 rounded-lg mb-4">
                        <div class="">
                            <p class="text-gray-800 text-xl font-semibold">
                                <strong>{{ $comment->user->name }}</strong>
                                <span class="text-sm text-gray-600 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                            </p>
                            <p class="mt-2 text-gray-700">{{ $comment->body }}</p>
                        </div>

                        <div>
                            @if (Auth::id() === $comment->user_id || Auth::id() === $comment->post->user_id)
                                <button type="button" class="cursor-pointer px-4 py-2 text-red-600 font-semibold rounded-lg shadow-md hover:bg-red-600 hover:text-white transition delete-item" 
                                    data-type="comment" data-id="{{ $comment->id }}">
                                    Delete
                                </button>
                        
                                <form id="delete-form-comment-{{ $comment->id }}" action="{{ route('comment.delete', ['post' => $post->id, 'comment' => $comment->id]) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".delete-item").forEach(button => {
            button.addEventListener("click", function () {
                let itemType = this.getAttribute("data-type");
                let itemId = this.getAttribute("data-id");
                let formId = `delete-form-${itemType}-${itemId}`;

                Swal.fire({
                    title: "Are you sure?",
                    text: `Once deleted, this ${itemType} cannot be recovered!`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(formId).submit();
                    }
                });
            });
        });
    });
</script>

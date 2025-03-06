<div class="grid md:grid-cols-2 gap-6">
    @foreach ($posts as $post)
        <a href="{{ route('post.show', $post->id) }}">
            <div class="bg-white rounded-lg shadow-md p-4">
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post_Image" class="w-full h-40 object-cover rounded-lg mb-4">

                <h2 class="text-xl font-bold text-gray-800 pb-2">{{ $post->title }}</h2>

                <p class="pb-2 truncate">{{ $post->content }}</p>

                <div class="mb-2">
                    @foreach ($post->categories as $category)
                        <span class="bg-blue-500 text-white px-2 py-1 rounded text-sm">{{ $category->name }}</span>
                    @endforeach
                </div>

                <div class="text-gray-500 text-sm font-bold">
                    <p>Written By: {{ $post->user->name }}</p>
                    <p>{{ $post->created_at->format('F j, Y, g:i a') }}</p>
                </div>
            </div>
        </a>
    @endforeach
</div>
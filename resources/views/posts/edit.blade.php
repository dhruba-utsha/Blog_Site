<x-layout>
    <div class="container mx-auto mt-10">
        <h2 class="text-3xl font-semibold text-gray-800">Edit Post</h2>

        <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="category" class="block text-gray-700 font-semibold mb-2">Select Categories</label>
                <div class="grid grid-cols-3 gap-2">
                    @foreach ($categories as $category)
                        <div class="flex items-center">
                            <input type="checkbox" name="category_id[]" value="{{ $category->id }}" 
                                   class="form-checkbox text-blue-500 rounded" 
                                   {{ in_array($category->id, $post->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                            <label for="category" class="ml-2">{{ $category->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
    
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
    
            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-semibold mb-2">Content</label>
                <textarea name="content" id="content" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('content', $post->content) }}</textarea>
            </div>
    
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-semibold mb-2">Image</label>
                <input type="file" name="image" id="image" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <p class="text-gray-500 text-sm mt-1">Leave empty if you don't want to change the image.</p>
            </div>
    
            <div class="flex justify-center mb-10">
                <button type="submit" class=" cursor-pointer px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                    Update Post
                </button>
            </div>
        </form>
    </div>
</x-layout>
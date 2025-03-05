<x-layout>
    <div class="bg-gray-100 min-h-screen">
        <div class="container mx-auto mt-10">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Create a New Post</h1>

            <form method="POST" action="{{route('post.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Select Categories</label>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach ($categories as $category)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="category_id[]" value="{{ $category->id }}" class="form-checkbox text-blue-500">
                                <span>{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Title</label>
                    <input type="text" name="title" placeholder="Enter Post Title"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-gray-700 font-semibold mb-2">Content</label>
                    <textarea name="content" rows="5" placeholder="Enter Post Content"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-semibold mb-2">Upload Image</label>
                    <input type="file" name="image" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="flex space-x-4">
                    <button type="submit" class= "cursor-pointer bg-green-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-600">
                        Create Post
                    </button>

                    <a href="/dashboard"
                    class="text-center bg-gray-500 text-white font-semibold py-2 px-6 rounded-lg shadow-md hover:bg-gray-600 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
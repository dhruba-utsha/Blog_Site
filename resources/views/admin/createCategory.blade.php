<x-layout>
    <div class="max-w-lg mx-auto mt-12 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Create Category</h2>

        <form method="POST" action="{{ route('admin.categoryStore') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Category Name</label>
                <input type="text" name="name" placeholder="Enter Category Name" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Category Description</label>
                <textarea name="description" placeholder="Enter Category Description" class="w-full h-[10rem] px-4 py-2 border rounded-lg"></textarea>
            </div>

            <div class="text-center space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition cursor-pointer">
                    Create Category
                </button>

                <button><a href="{{route('admin.panel')}}"
                    class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition">
                        Cancel
                </a></button>
            </div>
        </form>
    </div>
</x-layout>
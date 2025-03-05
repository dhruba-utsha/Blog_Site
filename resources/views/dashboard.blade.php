<x-layout>
    <div class="grid justify-center text-center mt-32">
        <div>
            <h2 class="text-3xl font-semibold text-gray-800">Welcome to Your Dashboard</h2>
            <p class="text-gray-600 mt-2 mb-6">Manage your posts and settings here.</p>
        </div>
    
        <div class="space-x-4">    
            <a href="{{ route('posts.index') }}" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition">
                See Posts
            </a>

            @if(auth()->user()->role !== 'user')
                <a href="{{ route('post.create') }}" class="px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-700 transition">
                    Create Post
                </a>
            @endif

            <a href="{{ route('logout') }}" class="px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 transition">
                LogOut
            </a>
        </div>
    </div>
</x-layout>

</html>
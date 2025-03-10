<x-layout>
    <div class="container mx-auto grid grid-cols-2 justify-center items-center my-20 gap-8">
        <div class="flex flex-col justify-center space-y-6">
            <h2 class="text-4xl font-bold text-gray-800">Welcome to <span class="text-blue-600">InnovateBlog</span></h2>
            <p class="text-gray-600 text-justify">
                InnovateBlog is a platform where users can share their thoughts, explore trending posts, and engage in meaningful discussions. 
                Stay updated with the latest insights and connect with a community of like-minded individuals.
            </p>
            <div class="space-x-4">
                <a href="{{ route('posts.index') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-green-700 transition">
                    Explore Now
                </a>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.panel') }}" class="bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-orange-600 transition">
                        Admin Panel
                    </a>
                @endif
            </div>
        </div>

        @if(auth()->user()->role === 'admin')
            <div class="grid gap-6 ml-10">
                <div class="bg-gray-300 py-6 rounded-lg shadow-md text-center space-y-2">
                    <h3 class="text-xl font-semibold text-gray-700">Total Users</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalUsers }}</p>
                </div>

                <div class="bg-gray-300 py-6 rounded-lg shadow-md text-center space-y-2">
                    <h3 class="text-xl font-semibold text-gray-700">Total Categories</h3>
                    <p class="text-3xl font-bold text-orange-500">{{ $totalCategories }}</p>
                </div>

                <div class="bg-gray-300 py-6 rounded-lg shadow-md text-center space-y-2">
                    <h3 class="text-xl font-semibold text-gray-700">Total Posts</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $totalPosts }}</p>
                </div>
            </div>

        @else
            <div>
                <img src="images/banner1.jpg" alt="banner-image" class="h-[400px] w-full">
            </div>
        @endif
    </div>
</x-layout>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog-App</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col justify-center items-center">
    <div class="container mx-auto py-6">
        <div class="text-center mb-10">
            <h1 class="text-5xl font-bold text-gray-800 mb-6">Welcome to Innovate-Blog</h1>
            <p class="text-lg text-gray-600 mb-8">Explore amazing content and share your thoughts.</p>
            @auth
                <div>
                    <a href="/dashboard" 
                        class="px-6 py-3 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition">
                        Dashboard
                    </a>
                </div>
            @else
                <div class="space-x-4">
                    <a href="/login" 
                        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                        Login
                    </a>

                    <a href="/registration" 
                        class="px-6 py-3 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition">
                        Register
                    </a>
                </div>
            @endauth
        </div>

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
                @endforeach
            </a>
        </div>
    </div>
</body>
</html>
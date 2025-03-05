<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog-App</title>
    @vite('resources/css/app.css')
</head>
<body>
    <header>
        <nav class="bg-blue-600 text-white shadow-md">
            <div class="container mx-auto flex justify-between items-center py-4">
                
                <div><a href="{{ route('home') }}" class="text-2xl font-bold">InnovateBlog</a></div>
        
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-gray-200">Dashboard</a>
                    <a href="{{ route('posts.index') }}" class="hover:text-gray-200">All Posts</a>
                    @if(auth()->user()->role !== 'user')
                    <a href="{{ route('post.create') }}" class="hover:text-gray-200">Create Post</a>
                    @endif
                    <a href="{{ route('logout') }}" class="hover:text-gray-200">LogOut</a>
                    <a href="{{ route('home') }}" class="bg-orange-400 px-3 py-2 rounded-lg cursor-pointer hover:text-gray-200">
                        {{ auth()->user()->name }} ({{ auth()->user()->role }})</a>
                </div>
            </div>
        </nav>
    </header>


    {{ $slot }}
</body>
</html>

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
            <div class="container mx-auto flex justify-between items-center py-4 px-6">
                
                <div><a href="/" class="text-2xl font-bold">InnovateBlog</a></div>
        
                <div class="flex space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-gray-200">Dashboard</a>
                    <a href="{{ route('posts.index') }}" class="hover:text-gray-200">All Posts</a>
                    <a href="{{ route('post.create') }}" class="hover:text-gray-200">Create Post</a>
                    <a href="{{ route('logout') }}" class="hover:text-gray-200">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        {{ $slot }}
    </main>
</body>
</html>
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
            <h1 class="text-5xl font-bold text-gray-800 mb-6">InnovateBlog</h1>
            <p class="text-lg text-gray-600 mb-8">Discover, share, and explore ideas from people around the world. Join us and start your blogging journey today!</p>
            @auth
                <div>
                    <a href="/dashboard" 
                        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
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
                        class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition">
                        Register
                    </a>
                </div>
            @endauth
        </div>

        @include('components.postList', ['posts' => $posts])
    </div>
</body>
</html>
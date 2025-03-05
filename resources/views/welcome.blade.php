<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog-App</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col justify-center items-center">
    <div class="text-center">
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
</body>
</html>
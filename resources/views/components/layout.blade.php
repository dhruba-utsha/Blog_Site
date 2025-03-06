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
        
                <div class="flex items-center space-x-5 font-semibold">
                    <a href="{{ route('home') }}" class="hover:text-gray-200">Dashboard</a>
                    <a href="{{ route('posts.index') }}" class="hover:text-gray-200">All Posts</a>

                    @if(auth()->user()->role !== 'user')
                        <a href="{{ route('post.create') }}" class="">Create Post</a>
                    @endif

                    <select id="userActions" class="bg-blue-300 px-3 py-2 uppercase rounded-lg cursor-pointer text-black font-semibold">
                        <option selected disabled>{{ auth()->user()->name }} ({{ auth()->user()->role }})</option>
                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'author')
                            <option value="{{ route('post.myPost') }}">My Posts</option>
                        @endif
                        <option value="{{ route('logout') }}">Log Out</option>
                    </select>
                </div>
            </div>
        </nav>
    </header>

    {{ $slot }}
</body>
</html>

<script>
    document.getElementById("userActions").addEventListener('change', function() {
        if (this.value) {
            window.location.href = this.value;
        }
    });
</script>

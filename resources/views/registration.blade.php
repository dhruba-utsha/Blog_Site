<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center py-10">
    <h1 class="text-4xl font-bold text-gray-800 mb-6">Sign Up</h1>

    <form method="POST" action="{{route('registration.post')}}" class="w-full max-w-lg bg-white p-6 rounded-lg shadow-lg">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Select a Role</label>
            <select name="role"
                class="cursor-pointer w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="admin">Admin</option>
                <option value="author">Author</option>
                <option value="user">User</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Name</label>
            <input type="text" name="name" placeholder="Enter Name"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" placeholder="Enter Email"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Password</label>
            <input type="password" name="password" placeholder="Enter Password"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div class="mt-6 flex space-x-4">
            <button type="submit"
                class="cursor-pointer w-1/2 bg-green-500 text-white font-semibold py-2 rounded-lg shadow-md hover:bg-green-600 transition">
                Register
            </button>

            <a href="/"
                class="w-1/2 text-center bg-gray-500 text-white font-semibold py-2 rounded-lg shadow-md hover:bg-gray-600 transition">
                Cancel
            </a>
        </div>
    </form>
</body>
</html>
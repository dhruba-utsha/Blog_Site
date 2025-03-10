<x-layout>
    <div class="max-w-lg mx-auto mt-12 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Edit User</h2>

        <form action="{{ route('admin.userUpdate', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Name</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full px-4 py-2 border rounded-lg bg-gray-200" disabled>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-2 border rounded-lg bg-gray-200" disabled>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">User Role</label>
                <select name="role" class="w-full px-4 py-2 border rounded-lg">
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                    <option value="author" {{ $user->role === 'author' ? 'selected' : '' }}>Author</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="text-center space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition cursor-pointer">
                    Update Role
                </button>

                <button><a href="{{route('admin.panel')}}"
                    class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition">
                        Cancel
                </a></button>
            </div>
        </form>
    </div>
</x-layout>
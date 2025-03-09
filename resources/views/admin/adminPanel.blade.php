<x-layout>
    <div class="container mx-auto mt-10">
        <h2 class="text-3xl font-bold text-center">Admin Panel</h2>

        <div class="grid gap-8 mt-6">

            <div class="bg-gray-200 p-6 rounded-lg shadow">
                <h3 class="text-xl font-bold mb-4">Manage Users</h3>
                <table class="w-full border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 border border-gray-300">
                            <th class="p-3 border border-gray-300 text-center">Name</th>
                            <th class="p-3 border border-gray-300 text-center">Email</th>
                            <th class="p-3 border border-gray-300 text-center">Role</th>
                            <th class="p-3 border border-gray-300 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="border border-gray-300">
                            <td class="p-3 border border-gray-300 text-center">{{ $user->name }}</td>
                            <td class="p-3 border border-gray-300 text-center">{{ $user->email }}</td>
                            <td class="p-3 border border-gray-300 text-center">{{ $user->role }}</td>
                            <td class="p-3 border border-gray-300 flex justify-center gap-4">
                                <a href="{{ route('admin.user.edit',  $user->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>

                                <form action="{{ route('admin.user.delete', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded cursor-pointer">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-gray-200 p-6 rounded-lg shadow">
                <div class="flex justify-between">
                    <h3 class="text-xl font-bold mb-4">Manage Categories</h3>
            
                    <div>
                        <a class="bg-green-500 text-white px-4 py-2 rounded">Create Category</a>
                    </div>
                </div>
                
                <table class="w-full border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 border border-gray-300">
                            <th class="p-3 border border-gray-300 text-center">Category Name</th>
                            <th class="p-3 border border-gray-300 text-center">Category Description</th>
                            <th class="p-3 border border-gray-300 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr class="border border-gray-300">
                            <td class="p-3 border border-gray-300 text-center">{{ $category->name }}</td>
                            <td class="p-3 border border-gray-300 text-center">{{ $category->description }}</td>
                            <td class="p-3 border border-gray-300 text-center space-x-2">
                                <a class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            

        </div>
    </div>
</x-layout>
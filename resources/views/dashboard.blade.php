<x-layout>
    <div class="grid justify-center text-center mt-32">
        <div>
            <h2 class="text-3xl font-semibold text-gray-800">Welcome to <span class="text-4xl text-orange-700 font-bold uppercase">"{{ auth()->user()->role }}"</span> Dashboard</h2>
            <p class="text-gray-600 mt-2 mb-6">Manage your posts and settings here.</p>
        </div>
    </div>
</x-layout>

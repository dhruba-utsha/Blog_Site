<x-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-4xl font-bold text-gray-800 mb-6 text-center">{{ $pageTitle }}</h1>

        @include('components.postList', ['posts' => $posts])
</x-layout>
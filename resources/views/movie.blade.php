<x-app-layout title="{{ $movie->title }}">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-center text-3xl font-bold text-blue-500 mb-4">{{ $movie->title }}</h1>
        @foreach ($movie['categories'] as $category)
            <h3 class="inline-block text-xl font-medium mb-2 text-green-400"> {{ $category->name }}
            </h3>
        @endforeach
        <div class="relative overflow-hidden mb-8 w-[50%]"> 
            <img src="{{ $movie->poster }}" alt=""class=" rounded-lg shadow-lg w-full">
            <div class="absolute inset-0 bg-black opacity-50 hover:opacity-75"></div>
        </div>

        <div class="flex items-center mb-4">
            <p class="text-gray-700 mr-4">Year: {{ $movie->year }}</p>
            <p class="text-gray-700">Directed by: {{ $movie['director']->name }}</p>
        </div>
        <a href="/">Home</a>
    </div>
</x-app-layout>

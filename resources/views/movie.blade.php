<x-app-layout>
    @foreach ($movie['categories'] as $movie)
        <h1>{{$movie->name}}</h1>
    @endforeach
</x-app-layout>
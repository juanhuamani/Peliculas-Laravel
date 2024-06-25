<x-app-layout title="Home">
    <x-navbar />

    <form action="/" method="GET" class="flex flex-row flex-1">
        <div class="flex justify-center items-center gap-4 flex-col px-5" style="background: linear-gradient(94deg, rgba(0,0,0,1) 0%, rgba(6,163,216,1) 53%, rgba(34,206,241,1) 100%);">
            <div class="flex flex-col gap-5">
                <input type="text" name="searchName" id="searchName" placeholder="Search by name"
                    class="border-2 border-gray-300 bg-gray-600 h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none text-gray-300"
                    value="{{ old('searchName', $searchName) }}">
                <input type="number" name="searchYear" id="searchYear" placeholder="Search by year"
                    class="border-2 border-gray-300 bg-gray-600 h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none text-gray-300"
                    value="{{ old('searchYear', $searchYear) }}">
                <select name="directors" id="directors"
                    class="border-2 border-gray-300 bg-gray-600 h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none text-gray-300">
                    <option value="" class="text-gray-300">Select Directors</option>
                    @foreach ($directors as $director)
                        <option value="{{ $director->id }}" class="text-gray-300"
                            {{ old('director', $directorS) == $director->id ? 'selected' : '' }}>
                            {{ $director->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col gap-5">
                <ul
                    class="w-48 text-sm font-medium border rounded-lg bg-gray-700 border-gray-600 text-white">
                    @foreach ($categories as $category)
                        <li class="w-full border-b rounded-t-lg border-gray-600">
                            <div class="flex items-center ps-3">
                                <input 
                                    id="category-{{ $category->id }}" 
                                    name="categories[]" 
                                    type="checkbox"
                                    value="{{ $category->id }}"
                                    {{ in_array($category->id, $categoriesS ?? []) ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 rounded ring-blue-500 focus:ring-blue-600 ring-offset-gray-700 focus:ring-offset-gray-700 focus:ring-2 bg-gray-600 border-gray-500">
                                <label for="category-{{ $category->id }}"
                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-300">{{ $category->name }}</label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">Search</button>
        </div>
        @if ($movies->count())
            <div class="w-full">
                <div class="flex flex-wrap justify-center items-center gap-14 ">
                    @foreach ($movies as $movie)
                        <x-movie-card :movie="$movie" />
                    @endforeach
                </div>

                <div class="flex justify-center items-center gap-4 mt-36">
                    @if ($movies->onFirstPage())
                        <span
                            class="bg-gray-500 text-white font-bold py-2 px-4 rounded cursor-not-allowed opacity-50">Previous</span>
                    @else
                        <a href="{{ $movies->previousPageUrl() }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Previous</a>
                    @endif

                    @if ($movies->hasMorePages())
                        <a href="{{ $movies->nextPageUrl() }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Next</a>
                    @else
                        <span
                            class="bg-gray-500 text-white font-bold py-2 px-4 rounded cursor-not-allowed opacity-50">Next</span>
                    @endif
                </div>
            </div>
        @else
            <h1
                class="mb-4 text-center mt-40 text-2xl leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl dark:text-white">
                NOT MOVIES FOUND</h1>
        @endif
    </form>
</x-app-layout>

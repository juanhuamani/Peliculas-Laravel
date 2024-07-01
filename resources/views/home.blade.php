<x-app-layout title="Home">
    <!-- Navbar -->
    <x-navbar />

    <!-- Forms -->
    <form action="/" method="GET" class="flex flex-row flex-1">
        <div class="flex justify-center items-center gap-4 flex-col px-5 bg-gray-400">
            <div class="flex flex-col gap-5">

            <!-- Input username -->
                <input type="text" name="searchName" id="searchName" placeholder="Search by name"
                    class="home-input"
                    value="{{ old('searchName', $searchName) }}">
            
            <!-- Input year -->
                <input type="number" name="searchYear" id="searchYear" placeholder="Search by year"
                    class="home-input"
                    value="{{ old('searchYear', $searchYear) }}">

            <!-- Select directors -->
                <select name="directors" id="directors"
                    class="home-input ">
                    <option value="" class="text-gray-300">Select Directors</option>
                    @foreach ($directors as $director)
                        <option value="{{ $director->id }}" class="text-gray-300"
                            {{ old('director', $directorS) == $director->id ? 'selected' : '' }}>
                            {{ $director->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Select categories -->
            <div class="flex flex-col gap-5">
                <ul class="w-48 text-sm font-medium border rounded-lg bg-gray-700 border-gray-600 text-white">
                    @foreach ($categories as $category)
                        <li class="w-full border-b rounded-t-lg border-gray-600">
                            <div class="flex items-center ps-3">
                                <input id="category-{{ $category->id }}" name="categories[]" type="checkbox"
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

        <!-- Movies -->
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
                            class="home-action-disable">Previous</span>
                    @else
                        <a href="{{ $movies->previousPageUrl() }}"
                            class="home-action-active">Previous</a>
                    @endif

                    @if ($movies->hasMorePages())
                        <a href="{{ $movies->nextPageUrl() }}"
                            class="home-action-active">Next</a>
                    @else
                        <span
                            class="home-action-disable">Next</span>
                    @endif
                </div>
            </div>
        @else
            <h1
                class="mb-4 text-center mt-40 text-2xl leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl dark:text-white">NOT MOVIES FOUND</h1>
        @endif
    </form>
</x-app-layout>

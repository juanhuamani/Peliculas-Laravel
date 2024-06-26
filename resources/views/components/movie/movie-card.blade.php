

<div class=" bg-gray-100 py-6 flex flex-col justify-center sm:py-2">
    <div class="py-3 sm:max-w-lg sm:mx-auto">
      <div class="bg-white shadow-lg border-gray-100 max-h-72	 border sm:rounded-3xl p-3 flex space-x-8">
        <div class="h-42 overflow-visible w-1/2">
            <img class="rounded-3xl shadow-lg h-42 object-cover	" src={{ $movie['poster'] }} alt="">
        </div>
        <div class="flex flex-col w-1/2 space-y-4">
          <div class="flex justify-between items-start">
            <h2 class="text-3xl font-bold">{{ $movie['title'] }}</h2>
            <div class="bg-yellow-400 font-bold rounded-xl p-2">{{ number_format(mt_rand(10, 100) / 10, 1) }}</div>
          </div>
          <div>
            <div class="text-sm text-gray-400">{{ $movie['director']->name }}</div>
            <div class="text-lg text-gray-800">{{ $movie['year'] }}</div>
            @foreach ($movie['categories'] as $category)
                <span class="text-sm text-gray-400">{{ $category->name }}</span>
            @endforeach
            <a href="/movies/{{$movie['id']}}" type="button" class="w-[50%] text-center mt-6 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">More info</a>
          </div>
        </div>
  
      </div>
    </div>
    
  </div>

<x-app-layout title="Login">
    <div class="h-[100vh] flex justify-center items-center flex-col">
        <h1
            class="mb-10 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
            LOGIN</h1>
        <form class="max-w-sm mx-auto" action="/login" method="POST">
            @csrf
            @if ($errors->any())
                <div x-data="{ show: true }" x-effect="setTimeout(() => show = false, 5000)" x-transition x-show="show">
                    <ul class="absolute animation top-52 ">
                        @foreach ($errors->all() as $error)
                            <x-bad-notification>{{ $error }}</x-bad-notification>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="max-w-sm space-y-3">
                <div class="relative">
                    <input type="text"
                        class="peer py-3 px-4 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                        placeholder="Enter name"
                        name="username"
                        id="username"
                        required>
                    <div
                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                        <svg class="flex-shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                </div>

                <div class="relative">
                    <input type="password"
                        class="peer py-3 px-4 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                        placeholder="Enter password"
                        id="password" 
                        name="password"
                        required>
                    <div
                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                        <svg class="flex-shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M2 18v3c0 .6.4 1 1 1h4v-3h3v-3h2l1.4-1.4a6.5 6.5 0 1 0-4-4Z"></path>
                            <circle cx="16.5" cy="7.5" r=".5"></circle>
                        </svg>
                    </div>
                </div>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 mt-10 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Submit
            </button>
            <h2 class="">¿No tienes cuenta? <a class="text-blue-600" href="/register">Registrate</a> </h2>
        </form>
    </div>
</x-app-layout>

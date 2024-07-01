<x-app-layout title="Register">
    @vite(['resources/scss/register.scss'])
    <div class="h-[100vh] flex justify-center items-center flex-col">
        <!-- Title -->
        <h1 class="register-title">REGISTER</h1>

        <!-- Form -->
        <form class="max-w-sm mx-auto" action="/register" method="POST">
            @csrf

            <!-- Input Username -->
            <div class="mb-5">
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" id="username" name="username" class="register-input" value = "{{ old('username', $usernameSend) }}" />
                @error('username')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Email -->
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                <input type="email" id="email" name="email" class="register-input" value = "{{ old('email', $emailSend) }}" />
                @error('email')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Password -->
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                <input type="password" id="password" name="password" class="register-input" value = "{{ old('password', $passwordSend) }}" />
                @error('password')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Password Confirmation -->
            <button type="submit" class="register-button">
                Register new account
            </button>
        </form>

        <!-- Login -->
        <h2 class="mt-8">You have an account <a class="text-blue-600" href="/login">Login</a> </h2>
    </div>
</x-app-layout>

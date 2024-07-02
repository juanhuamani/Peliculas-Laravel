<x-app-layout title="Register">
    <div class="h-[100vh] flex justify-center items-center flex-col">
        <!-- Title -->
        <h1 class="register-title">REGISTER</h1>

        <!-- Form -->
        <form class="max-w-sm mx-auto" action={{ route('register') }} method="POST">
            @csrf

            <!-- Input Username -->
            <div class="mb-5">
                <label for="username" class="register-label">Name</label>
                <input type="text" id="username" name="username" class="register-input" value = "{{ old('username', $usernameSend) }}" />
                @error('username')
                    <div class="error-text">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Email -->
            <div class="mb-5">
                <label for="email" class="register-label">Email</label>
                <input type="email" id="email" name="email" class="register-input" value = "{{ old('email', $emailSend) }}" />
                @error('email')
                    <div class="error-text">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Password -->
            <div class="mb-5">
                <label for="password" class="register-label">Password</label>
                <input type="password" id="password" name="password" class="register-input" value = "{{ old('password', $passwordSend) }}" />
                @error('password')
                    <div class="error-text">
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

<x-guest-layout>
    <!-- Full-screen background gradient -->
    <div class="fixed inset-0 bg-gradient-to-br from-indigo-900 to-purple-900"></div>

    <!-- Large SMPKS Text in Background -->
    <div class="absolute inset-0 flex items-center justify-center z-0">
            <span class="text-[20rem] font-extrabold text-white opacity-10 select-none pointer-events-none" style="text-shadow: 0px 0px 20px rgba(0,0,0,0.5);">SMPKS</span>
        </div>

    <!-- Main content container (login card) -->
    <div class="min-h-screen flex items-center justify-center relative z-10">
        <div class="w-full sm:max-w-lg px-8 py-10 bg-white bg-opacity-15 shadow-2xl rounded-xl border border-indigo-300 backdrop-blur-md">
            <div class="text-center mb-10">
                <a href="{{ url('/') }}" class="text-5xl font-extrabold text-white tracking-tight block mb-3">SMPKS</a>
                <h2 class="text-3xl font-bold text-white">Selamat Datang Kembali!</h2>
                <p class="text-base text-indigo-100 mt-2">Silakan masuk untuk mengelola kontrak Anda.</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-6">
                    <x-input-label for="email" :value="__('Email')" class="text-white text-lg font-medium" />
                    <x-text-input id="email" class="block mt-2 w-full px-5 py-3 border border-indigo-300 rounded-lg shadow-sm focus:ring-indigo-400 focus:border-indigo-400 sm:text-lg placeholder-indigo-200 bg-white bg-opacity-20 text-white" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <x-input-label for="password" :value="__('Password')" class="text-white text-lg font-medium" />
                    <x-text-input id="password" class="block mt-2 w-full px-5 py-3 border border-indigo-300 rounded-lg shadow-sm focus:ring-indigo-400 focus:border-indigo-400 sm:text-lg placeholder-indigo-200 bg-white bg-opacity-20 text-white"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex justify-between items-center mb-8">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-indigo-300 text-indigo-400 shadow-sm focus:ring-indigo-500 bg-white bg-opacity-20" name="remember">
                        <span class="ms-2 text-base text-indigo-100">{{ __('Remember me') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-base text-indigo-200 hover:text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div class="flex items-center justify-end mt-6">
                    <x-primary-button class="w-full justify-center py-4 px-6 rounded-lg text-xl font-bold bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg transform hover:scale-105 transition duration-300">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
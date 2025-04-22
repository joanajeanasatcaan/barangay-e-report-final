<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ubojan Report System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: {
                                50: '#f0f9ff',
                                100: '#e0f2fe',
                                200: '#bae6fd',
                                300: '#7dd3fc',
                                400: '#38bdf8',
                                500: '#0ea5e9',
                                600: '#0284c7',
                                700: '#0369a1',
                                800: '#075985',
                                900: '#0c4a6e',
                            },
                            secondary: {
                                50: '#f8fafc',
                                100: '#f1f5f9',
                                200: '#e2e8f0',
                                300: '#cbd5e1',
                                400: '#94a3b8',
                                500: '#64748b',
                                600: '#475569',
                                700: '#334155',
                                800: '#1e293b',
                                900: '#0f172a',
                            },
                            barangay: {
                                green: '#2e7d32',
                                blue: '#1565c0',
                                red: '#c62828',
                                yellow: '#f9a825',
                            }
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="min-h-screen text-gray-900 bg-center bg-no-repeat bg-cover bg-gray-50 dark:bg-gray-900 dark:text-gray-100"
    style="background-image: url('https://img.freepik.com/free-vector/light-green-paint-background_78370-1861.jpg');">
            <!-- Navigation -->
        <nav class="bg-white shadow-md dark:bg-gray-800">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex items-center flex-shrink-0">
                            <svg class="w-auto h-8 text-barangay-green" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="ml-2 text-xl font-bold text-barangay-green">Ubojan<span class="text-barangay-blue">Report</span></span>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @if (Route::has('login'))
                            <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 border-b-2 border-transparent dark:text-gray-300 hover:border-gray-300 hover:text-gray-700 dark:hover:text-gray-100">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 border-b-2 border-transparent dark:text-gray-300 hover:border-gray-300 hover:text-gray-700 dark:hover:text-gray-100">
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 border-b-2 border-transparent dark:text-gray-300 hover:border-gray-300 hover:text-gray-700 dark:hover:text-gray-100">
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Mobile menu -->
        <div class="sm:hidden" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block py-2 pl-3 pr-4 text-base font-medium text-white border-l-4 bg-barangay-blue border-barangay-blue">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block py-2 pl-3 pr-4 text-base font-medium text-gray-500 border-l-4 border-transparent dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 hover:text-gray-700 dark:hover:text-gray-100">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block py-2 pl-3 pr-4 text-base font-medium text-gray-500 border-l-4 border-transparent dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 hover:text-gray-700 dark:hover:text-gray-100">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

        <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
                <span class="text-sm text-gray-600 ms-2">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>


        <!-- Footer -->
        <footer class="mt-12 bg-white dark:bg-gray-800">
            <div class="px-4 py-12 mx-auto overflow-hidden max-w-7xl sm:px-6 lg:px-8">
                <nav class="flex flex-wrap justify-center -mx-5 -my-2" aria-label="Footer">
                    <div class="px-5 py-2">
                        <a href="#" class="text-base text-gray-500 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            About
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-base text-gray-500 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            Services
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-base text-gray-500 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            Contact
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-base text-gray-500 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            Privacy
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-base text-gray-500 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            Terms
                        </a>
                    </div>
                </nav>
                <div class="flex justify-center mt-8 space-x-6">
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Facebook</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Twitter</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                </div>
                <p class="mt-8 text-base text-center text-gray-400 dark:text-gray-500">
                    &copy; 2025 Barangay Report System. All rights reserved.
                </p>
            </div>
        </footer>
    </body>
</html>

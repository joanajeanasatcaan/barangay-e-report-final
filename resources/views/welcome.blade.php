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
    <body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen bg-cover bg-center bg-no-repeat"
    style="background-image: url('https://img.freepik.com/free-vector/light-green-paint-background_78370-1861.jpg');">

    <!-- Navigation -->
        <nav class="bg-white dark:bg-gray-800 shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <svg class="h-8 w-auto text-barangay-green" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="ml-2 text-xl font-bold text-barangay-green">Ubojan<span class="text-barangay-blue">Report</span></span>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @if (Route::has('login'))
                            <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="border-transparent text-gray-500 dark:text-gray-300 hover:border-gray-300 hover:text-gray-700 dark:hover:text-gray-100 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="border-transparent text-gray-500 dark:text-gray-300 hover:border-gray-300 hover:text-gray-700 dark:hover:text-gray-100 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="border-transparent text-gray-500 dark:text-gray-300 hover:border-gray-300 hover:text-gray-700 dark:hover:text-gray-100 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
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
                        <a href="{{ url('/dashboard') }}" class="bg-barangay-blue text-white block pl-3 pr-4 py-2 border-l-4 border-barangay-blue text-base font-medium">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 hover:text-gray-700 dark:hover:text-gray-100 block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 hover:text-gray-700 dark:hover:text-gray-100 block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                    <span class="block text-barangay-green">Ubojan</span>
                    <span class="block text-barangay-blue">Report System</span>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-gray-500 dark:text-gray-300 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    A comprehensive system for managing barangay reports, complaints, and services.
                </p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Feature 1 -->
                <div class="pt-6">
                    <div class="flow-root bg-white dark:bg-gray-800 rounded-lg px-6 pb-8 shadow-md h-full">
                        <div class="-mt-6">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-barangay-green text-white mx-auto">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white text-center">Report Management</h3>
                            <p class="mt-2 text-base text-gray-500 dark:text-gray-300">
                                Easily submit and track reports for various barangay concerns including peace and order, sanitation, and infrastructure.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="pt-6">
                    <div class="flow-root bg-white dark:bg-gray-800 rounded-lg px-6 pb-8 shadow-md h-full">
                        <div class="-mt-6">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-barangay-red text-white mx-auto">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white text-center">Emergency Alerts</h3>
                            <p class="mt-2 text-base text-gray-500 dark:text-gray-300">
                                Receive and respond to emergency alerts and incidents reported by residents in real-time.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="mt-10 sm:mt-12">
                <div class="bg-barangay-green rounded-lg shadow-xl overflow-hidden">
                    <div class="px-6 py-8 sm:p-10 sm:pb-6">
                        <div class="flex justify-center">
                            <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-md bg-white text-barangay-green">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <h3 class="text-lg leading-6 font-medium text-white">Ready to get started?</h3>
                            <div class="mt-3 max-w-md mx-auto text-base text-green-100">
                                <p>
                                    Sign up now to access all barangay services and report management features.
                                </p>
                            </div>
                            <div class="mt-6">
                                @if (Route::has('register'))
                                    <div class="rounded-md shadow">
                                        <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-barangay-green bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                                            Register for free
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-5 bg-green-700 text-center">
                        <p class="text-sm leading-5 text-green-200">
                            Already have an account?
                            <a href="{{ route('login') }}" class="font-medium text-white hover:text-green-100 transition ease-in-out duration-150">
                                Sign in
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800 mt-12">
            <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
                <nav class="-mx-5 -my-2 flex flex-wrap justify-center" aria-label="Footer">
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
                <div class="mt-8 flex justify-center space-x-6">
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                </div>
                <p class="mt-8 text-center text-base text-gray-400 dark:text-gray-500">
                    &copy; 2023 Barangay Report System. All rights reserved.
                </p>
            </div>
        </footer>
    </body>
</html>

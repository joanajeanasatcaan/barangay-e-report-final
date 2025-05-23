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
                    },
                    boxShadow: {
                        'barangay': '0 4px 14px 0 rgba(0, 0, 0, 0.1)',
                        'barangay-lg': '0 10px 25px -5px rgba(0, 0, 0, 0.1)',
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen text-gray-900 bg-[url('/images/bg1.jpg')] bg-cover bg-center bg-no-repeat">

    <!-- Navigation -->
    <nav class="sticky top-0 z-50 border-green-300 shadow-sm bg-white/80 backdrop-blur-md dark:bg-gray-800/80">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex items-center flex-shrink-0">
                        <svg class="w-auto h-8 text-barangay-green" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="ml-2 text-xl font-bold text-barangay-green">Ubojan<span
                                class="text-barangay-blue">Report</span></span>
                    </div>
                </div>
                <div class="flex items-center">
                    @if (Route::has('login'))
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 transition-colors duration-200 border-b-2 border-transparent dark:text-gray-300 hover:border-barangay-green hover:text-gray-700 dark:hover:text-gray-100">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 transition-colors duration-200 border-b-2 border-transparent dark:text-gray-300 hover:border-barangay-green hover:text-gray-700 dark:hover:text-gray-100">
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 transition-colors duration-200 border-b-2 border-transparent dark:text-gray-300 hover:border-barangay-green hover:text-gray-700 dark:hover:text-gray-100">
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
                    <a href="{{ url('/dashboard') }}"
                        class="block py-2 pl-3 pr-4 text-base font-medium text-white rounded-md bg-barangay-blue">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="block py-2 pl-3 pr-4 text-base font-medium text-gray-600 transition-colors duration-200 rounded-md dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="block py-2 pl-3 pr-4 text-base font-medium text-gray-600 transition-colors duration-200 rounded-md dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </div>

    <!-- Main Content -->
    <main class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-barangay-green to-barangay-blue">Ubojan Report System</span>
            </h1>
            <p
                class="max-w-md mx-auto mt-3 text-base text-gray-600 dark:text-gray-300 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                A comprehensive system for managing barangay reports, complaints, and services.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 mt-16 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Feature 1 -->
            <div class="pt-6 transition-transform duration-300 hover:scale-105">
                <div class="flow-root h-full px-6 pb-8 bg-white border rounded-xl shadow-barangay-lg dark:bg-gray-800/50 backdrop-blur-sm border-gray-100/50 dark:border-gray-700/50">
                    <div class="-mt-6">
                        <div
                            class="flex items-center justify-center w-12 h-12 mx-auto text-white rounded-lg shadow-md bg-gradient-to-br from-barangay-blue to-blue-600">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-center text-gray-900 dark:text-white">Easy Report Submission</h3>
                        <p class="mt-2 text-base text-gray-600 dark:text-gray-300">
                            Residents can quickly and easily submit reports anytime through the system with just a few
                            clicks.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="pt-6 transition-transform duration-300 hover:scale-105">
                <div class="flow-root h-full px-6 pb-8 bg-white border rounded-xl shadow-barangay-lg dark:bg-gray-800/50 backdrop-blur-sm border-gray-100/50 dark:border-gray-700/50">
                    <div class="-mt-6">
                        <div
                            class="flex items-center justify-center w-12 h-12 mx-auto text-white rounded-lg shadow-md bg-gradient-to-br from-barangay-green to-green-600">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-center text-gray-900 dark:text-white">Real-Time Status Updates</h3>
                        <p class="mt-2 text-base text-gray-600 dark:text-gray-300">
                            Residents and officials can monitor the progress and status of reported incidents in
                            real-time.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="pt-6 transition-transform duration-300 hover:scale-105">
                <div class="flow-root h-full px-6 pb-8 bg-white border rounded-xl shadow-barangay-lg dark:bg-gray-800/50 backdrop-blur-sm border-gray-100/50 dark:border-gray-700/50">
                    <div class="-mt-6">
                        <div
                            class="flex items-center justify-center w-12 h-12 mx-auto text-white rounded-lg shadow-md bg-gradient-to-br from-barangay-yellow to-amber-500">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2h6v2a2 2 0 01-2 2h-2a2 2 0 01-2-2zM12 7v6m0 0l3-3m-3 3l-3-3" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-center text-gray-900 dark:text-white">Incident History and Analytics</h3>
                        <p class="mt-2 text-base text-gray-600 dark:text-gray-300">
                            Officials can view historical data of reports, generate summaries, and analyze trends for
                            better decision-making.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="mt-16 sm:mt-20">
            <div class="overflow-hidden shadow-2xl rounded-xl bg-gradient-to-br from-barangay-green to-green-600">
                <div class="px-6 py-12 sm:p-12 sm:pb-10">
                    <div class="flex justify-center">
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-16 h-16 bg-white rounded-lg shadow-md text-barangay-green">
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-8 text-center">
                        <h3 class="text-2xl font-medium leading-6 text-white">Ready to get started?</h3>
                        <div class="max-w-md mx-auto mt-4 text-lg text-green-100">
                            <p>
                                Sign up now to access all barangay services and report management features.
                            </p>
                        </div>
                        <div class="mt-8">
                            @if (Route::has('register'))
                                <div class="rounded-lg shadow-lg">
                                    <a href="{{ route('register') }}"
                                        class="flex items-center justify-center w-full px-8 py-4 text-lg font-medium text-white transition-all duration-300 bg-transparent border-2 border-white rounded-lg hover:bg-white hover:text-barangay-green md:text-xl md:px-12">
                                        Register for free
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="px-6 py-6 text-center bg-green-700/80">
                    <p class="text-sm leading-5 text-green-200">
                        Already have an account?
                        <a href="{{ route('login') }}"
                            class="font-medium text-white underline transition duration-150 ease-in-out hover:text-green-100 underline-offset-2">
                            Sign in
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="mt-24 bg-white/50 dark:bg-gray-800/50 backdrop-blur-md">
        <div class="px-4 py-12 mx-auto overflow-hidden max-w-7xl sm:px-6 lg:px-8">
            <nav class="flex flex-wrap justify-center -mx-5 -my-2" aria-label="Footer">
                <div class="px-5 py-2">
                    <a href="#"
                        class="text-base text-gray-600 transition-colors duration-200 dark:text-gray-300 hover:text-barangay-green dark:hover:text-white">
                        About
                    </a>
                </div>
                <div class="px-5 py-2">
                    <a href="#"
                        class="text-base text-gray-600 transition-colors duration-200 dark:text-gray-300 hover:text-barangay-green dark:hover:text-white">
                        Services
                    </a>
                </div>
                <div class="px-5 py-2">
                    <a href="#"
                        class="text-base text-gray-600 transition-colors duration-200 dark:text-gray-300 hover:text-barangay-green dark:hover:text-white">
                        Contact
                    </a>
                </div>
                <div class="px-5 py-2">
                    <a href="#"
                        class="text-base text-gray-600 transition-colors duration-200 dark:text-gray-300 hover:text-barangay-green dark:hover:text-white">
                        Privacy
                    </a>
                </div>
                <div class="px-5 py-2">
                    <a href="#"
                        class="text-base text-gray-600 transition-colors duration-200 dark:text-gray-300 hover:text-barangay-green dark:hover:text-white">
                        Terms
                    </a>
                </div>
            </nav>
            <div class="flex justify-center mt-8 space-x-6">
                <a href="#" class="text-gray-500 transition-colors duration-200 hover:text-barangay-green dark:text-gray-400 dark:hover:text-white">
                    <span class="sr-only">Facebook</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="#" class="text-gray-500 transition-colors duration-200 hover:text-barangay-green dark:text-gray-400 dark:hover:text-white">
                    <span class="sr-only">Twitter</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                    </svg>
                </a>
            </div>
            <p class="mt-8 text-base text-center text-gray-500 dark:text-gray-400">
                &copy; 2025 Barangay Report System. All rights reserved.
            </p>
        </div>
    </footer>
</body>

</html>

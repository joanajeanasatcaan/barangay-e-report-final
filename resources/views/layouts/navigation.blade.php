<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: {
                        50: '#f0fdf4',
                        100: '#dcfce7',
                        200: '#bbf7d0',
                        300: '#86efac',
                        400: '#4ade80',
                        500: '#22c55e',
                        600: '#16a34a',
                        700: '#15803d',
                        800: '#166534',
                        900: '#14532d',
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
                    accent: {
                        50: '#eff6ff',
                        100: '#dbeafe',
                        200: '#bfdbfe',
                        300: '#93c5fd',
                        400: '#60a5fa',
                        500: '#3b82f6',
                        600: '#2563eb',
                        700: '#1d4ed8',
                        800: '#1e40af',
                        900: '#1e3a8a',
                    }
                },
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
                },
                boxShadow: {
                    'nav': '0 4px 12px -2px rgba(0, 0, 0, 0.08), 0 2px 6px -1px rgba(0, 0, 0, 0.03)',
                    'dropdown': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
                }
            }
        }
    }
</script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<nav x-data="{ open: false }" class="sticky top-0 z-50 font-sans bg-white border-b border-green-300 backdrop-blur-md shadow-nav">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ Auth::user()->userType === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center group">
                        <div class="flex items-center flex-shrink-0">
                            <svg class="w-auto h-8 transition-all duration-300 text-primary-600 group-hover:text-accent-600 group-hover:scale-105" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="ml-2 text-xl font-bold text-gray-800 transition-all duration-300 group-hover:text-primary-600">
                                Ubojan<span class="text-accent-600 group-hover:text-primary-600">Report</span>
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links for Authenticated Users -->
                @auth
                    <div class="hidden sm:flex sm:items-center sm:ml-10">
                        <div class="flex space-x-2">
                            @if (Auth::user()->isAdmin())
                                <!-- Admin Links -->
                                <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')" class="px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 rounded-md hover:bg-primary-50 hover:text-primary-600 hover:shadow-sm">
                                    {{ __('All Reports') }}
                                </x-nav-link>
                            @else
                                <!-- User Links -->
                                <x-nav-link :href="route('reports.create')" :active="request()->routeIs('reports.create')" class="px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 rounded-md hover:bg-primary-50 hover:text-primary-600 hover:shadow-sm">
                                    {{ __('Add Report') }}
                                </x-nav-link>
                                <x-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.index')" class="px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 rounded-md hover:bg-primary-50 hover:text-primary-600 hover:shadow-sm">
                                    {{ __('Your Reports') }}
                                </x-nav-link>
                            @endif
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Right Side Links -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @guest
                    <!-- Unauthenticated User Links -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 rounded-md hover:text-primary-600 hover:bg-primary-50">
                            {{ __('Log In') }}
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white transition-all duration-200 rounded-md shadow-sm bg-accent-600 hover:bg-accent-700 hover:shadow">
                            {{ __('Register') }}
                        </a>
                    </div>
                @else
                    <!-- Authenticated User Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-700 transition-all duration-200 ease-in-out rounded-full hover:text-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                <div class="flex items-center">
                                    <span class="sr-only">Open user menu</span>
                                    <div class="flex items-center justify-center border rounded-full shadow-sm w-9 h-9 bg-primary-100 text-primary-600 border-primary-200">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <svg class="w-4 h-4 ml-2 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 border-b border-gray-100 bg-gray-50">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="border-t border-gray-100"></div>
                            <x-dropdown-link :href="route('profile.edit')" class="block px-4 py-3 text-sm text-gray-700 transition-colors duration-200 hover:bg-primary-50 hover:text-primary-600">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                        class="block px-4 py-3 text-sm text-red-600 transition-colors duration-200 hover:bg-red-50">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endguest
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition-all duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" :class="{'hidden': open, 'block': !open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="w-6 h-6" :class="{'hidden': !open, 'block': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
         class="absolute inset-x-0 z-50 p-2 origin-top-right transform top-16 sm:hidden">
        <div class="bg-white divide-y divide-gray-100 rounded-lg shadow-dropdown ring-1 ring-black ring-opacity-5">
            @auth
                @if (Auth::user()->isAdmin())
                    <!-- Admin Mobile Links -->
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')" class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:bg-primary-50 hover:text-primary-600">
                            {{ __('All Reports') }}
                        </x-responsive-nav-link>
                    </div>
                @else
                    <!-- User Mobile Links -->
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:bg-primary-50 hover:text-primary-600">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('reports.create')" :active="request()->routeIs('reports.create')" class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:bg-primary-50 hover:text-primary-600">
                            {{ __('Add Report') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.index')" class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:bg-primary-50 hover:text-primary-600">
                            {{ __('Your Reports') }}
                        </x-responsive-nav-link>
                    </div>
                @endif
            @else
                <!-- Guest Mobile Links -->
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')" class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:bg-primary-50 hover:text-primary-600">
                        {{ __('Log In') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" class="block px-3 py-2 text-base font-medium text-white rounded-md bg-accent-600 hover:bg-accent-700">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            @endauth

            @auth
                <!-- Authenticated User Mobile Menu -->
                <div class="px-4 py-3 bg-gray-50">
                    <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-500 truncate">{{ Auth::user()->email }}</div>
                </div>
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:bg-primary-50 hover:text-primary-600">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="block px-3 py-2 text-base font-medium text-red-600 rounded-md hover:bg-red-50">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>

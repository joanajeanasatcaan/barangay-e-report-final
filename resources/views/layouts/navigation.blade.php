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
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ Auth::user()->userType === 'admin' ? route('admin.dashboard') : route('dashboard') }}">
                        <!-- UbojanReport Logo -->
                        <div class="flex items-center flex-shrink-0">
                            <svg class="w-auto h-8 text-barangay-green" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="ml-2 text-xl font-bold text-barangay-green">Ubojan
                                <span class="text-barangay-blue">Report</span>
                            </span>
                        </div>
                    </a>

                </div>

                <!-- Navigation Links for Authenticated Users -->
                @auth
                    <div class="justify-between hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        @if (Auth::user()->isAdmin())
                            <!-- Admin Links -->
                            <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
                                {{ __('All Reports') }}
                            </x-nav-link>
                        @else
                            <!-- User Links -->
                            <x-nav-link :href="route('reports.create')" :active="request()->routeIs('reports.create')">
                                {{ __('Add Report') }}
                            </x-nav-link>
                            <x-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.index')">
                                {{ __('Your Reports') }}
                            </x-nav-link>
                        @endif
                    </div>
                @endauth
            </div>

            <!-- Links for Unauthenticated Users or Settings Dropdown for Authenticated Users -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @guest
                    <!-- Unauthenticated User Links -->
                    <a href="{{ route('login') }}" class="mr-4 text-sm font-medium text-gray-700 hover:text-gray-900">
                        {{ __('Log In') }}
                    </a>
                    <a href="{{ route('register') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                        {{ __('Register') }}
                    </a>
                @else
                    <!-- Authenticated User Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endguest
            </div>

            <!-- Hamburger for Mobile -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if (Auth::user()->isAdmin())
                    <!-- Admin Responsive Links -->
                    <x-responsive-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
                        {{ __('All Reports') }}
                    </x-responsive-nav-link>
                @else
                    <!-- User Responsive Links -->
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('reports.create')" :active="request()->routeIs('reports.create')">
                        {{ __('Add Report') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.index')">
                        {{ __('Your Reports') }}
                    </x-responsive-nav-link>
                @endif
            @else
                <!-- Unauthenticated Responsive Links -->
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Log In') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options (Authenticated Users Only) -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>

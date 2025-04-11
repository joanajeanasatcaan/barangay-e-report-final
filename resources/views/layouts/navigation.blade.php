<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Branding -->
            <div class="flex items-center space-x-2">
                <img src="{{ asset('logo-green.png') }}" class="h-8 w-8" alt="Logo">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold">
                    <span class="text-green-700">Ubojan</span><span class="text-blue-700">Report</span>
                </a>
            </div>

            <!-- Authenticated Links -->
            @auth
                <div class="hidden sm:flex space-x-4 items-center">
                    <x-nav-link :href="route('reports.create')" class="text-sm px-4 py-2 border border-green-700 text-green-700 rounded hover:bg-green-700 hover:text-white transition">
                        {{ __('Add Report') }}
                    </x-nav-link>
                    <x-nav-link :href="route('reports.index')" class="text-sm px-4 py-2 border border-green-700 text-green-700 rounded hover:bg-green-700 hover:text-white transition">
                        {{ __('Your Reports') }}
                    </x-nav-link>

                    <!-- Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-700 hover:text-green-700 focus:outline-none">
                                <div>{{ Auth::user()->name }}</div>
                                <svg class="ml-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a1 1 0 011.42 0L10 10.59l3.35-3.38a1 1 0 011.41 1.42l-4.06 4.06a1 1 0 01-1.41 0L5.22 8.63a1 1 0 010-1.42z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else
                <!-- Guest Links -->
                <div class="space-x-4 hidden sm:flex">
                    <a href="{{ route('login') }}" class="text-sm text-blue-700 hover:underline">Log in</a>
                    <a href="{{ route('register') }}" class="text-sm text-blue-700 hover:underline">Register</a>
                </div>
            @endauth

            <!-- Mobile Menu -->
            <div class="sm:hidden">
                <button @click="open = !open" class="text-gray-700 hover:text-green-700">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

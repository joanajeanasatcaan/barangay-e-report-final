<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('All Incident Reports') }}
        </h2>
        <p class="text-gray-500">View and manage all incident reports from Barangay Ubojan residents</p>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Report Summary -->
                    <h3 class="mb-4 text-lg font-medium">Report Summary</h3>
                    <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-3">
                        <div class="p-4 bg-indigo-100 rounded-lg shadow">
                            <h4 class="text-sm font-semibold text-gray-700">Pending Reports</h4>
                            <p class="text-2xl font-bold text-indigo-800">{{ $reports->where('status', 'Pending')->count() }}</p>
                        </div>
                        <div class="p-4 bg-blue-100 rounded-lg shadow">
                            <h4 class="text-sm font-semibold text-gray-700">On Progress Reports</h4>
                            <p class="text-2xl font-bold text-blue-800">{{ $reports->where('status', 'On Progress')->count() }}</p>
                        </div>
                        <div class="p-4 bg-green-100 rounded-lg shadow">
                            <h4 class="text-sm font-semibold text-gray-700">Resolved Reports</h4>
                            <p class="text-2xl font-bold text-green-800">{{ $reports->where('status', 'Resolved')->count() }}</p>
                        </div>
                    </div>

                    <!-- Logout Form -->
                    <div class="mt-6">
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
            </div>
        </div>
    </div>
</x-app-layout>

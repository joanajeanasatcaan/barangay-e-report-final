<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col space-y-2">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                {{ __('Welcome Back') }}
            </h2>
            <p class="text-gray-600">View your reports and submit new incidents</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session('success'))
                <div class="p-4 mb-6 rounded-lg bg-emerald-50 ring-1 ring-emerald-200">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 font-medium text-emerald-800">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-5 mb-8 sm:grid-cols-2 lg:grid-cols-3">
                <div class="overflow-hidden bg-white rounded-lg shadow">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-md bg-indigo-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div class="flex-1 ml-4">
                                <h3 class="text-sm font-medium text-gray-500 truncate">Pending Reports</h3>
                                <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $reports->where('status', 'Pending')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden bg-white rounded-lg shadow">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-md bg-blue-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="flex-1 ml-4">
                                <h3 class="text-sm font-medium text-gray-500 truncate">In Progress</h3>
                                <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $reports->where('status', 'On Progress')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden bg-white rounded-lg shadow">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-md bg-green-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1 ml-4">
                                <h3 class="text-sm font-medium text-gray-500 truncate">Resolved</h3>
                                <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $reports->where('status', 'Resolved')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Your Reports</h3>
                    <p class="max-w-2xl mt-1 text-sm text-gray-500">Overview of all your submitted reports</p>
                </div>

                <div class="p-6 border-t border-gray-200">
                    @if ($reports->isEmpty())
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">No reports yet</h3>
                            <p class="mt-1 text-gray-500">You haven't submitted any reports yet.</p>
                            <div class="mt-6">
                                <a href="{{ route('reports.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Submit New Report
                                </a>
                            </div>
                        </div>
                    @else
                        <!-- Status Sections -->
                        @if ($reports->where('status', 'Pending')->count() > 0)
                            <div class="mb-8">
                                <h4 class="flex items-center mb-4 text-base font-medium text-gray-900">
                                    <span class="flex items-center justify-center w-6 h-6 mr-2 text-sm font-semibold text-white bg-yellow-500 rounded-full">P</span>
                                    Pending Reports
                                </h4>
                                <!-- Report cards would go here -->
                            </div>
                        @endif

                        @if ($reports->where('status', 'On Progress')->count() > 0)
                            <div class="mb-8">
                                <h4 class="flex items-center mb-4 text-base font-medium text-gray-900">
                                    <span class="flex items-center justify-center w-6 h-6 mr-2 text-sm font-semibold text-white bg-blue-500 rounded-full">I</span>
                                    In Progress
                                </h4>
                                <!-- Report cards would go here -->
                            </div>
                        @endif

                        @if ($reports->where('status', 'Resolved')->count() > 0)
                            <div class="mb-8">
                                <h4 class="flex items-center mb-4 text-base font-medium text-gray-900">
                                    <span class="flex items-center justify-center w-6 h-6 mr-2 text-sm font-semibold text-white bg-green-500 rounded-full">R</span>
                                    Resolved Reports
                                </h4>
                                <!-- Report cards would go here -->
                            </div>
                        @endif

                        <div class="mt-8">
                            <a href="{{ route('reports.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Submit New Report
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

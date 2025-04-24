<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col space-y-1">
            <h2 class="text-2xl font-bold text-gray-900">
                {{ __('Admin Dashboard') }}
            </h2>
            <p class="text-gray-600">Manage and monitor incident reports from Barangay Ubojan residents</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Success Notification -->
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

            <!-- Stats Overview -->
            <div class="mb-8">
                <h3 class="mb-4 text-lg font-semibold text-gray-900">Report Summary</h3>
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">
                    <!-- Pending Reports Card -->
                    <div class="overflow-hidden bg-white rounded-lg shadow">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 p-3 bg-indigo-100 rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div class="flex-1 ml-4">
                                    <dt class="text-sm font-medium text-gray-500 truncate">Pending Reports</dt>
                                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $pendingCount }}</dd>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.index', ['status' => 'Pending']) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                    View pending reports<span aria-hidden="true"> &rarr;</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- In Progress Card -->
                    <div class="overflow-hidden bg-white rounded-lg shadow">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 p-3 bg-blue-100 rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1 ml-4">
                                    <dt class="text-sm font-medium text-gray-500 truncate">In Progress</dt>
                                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $onProgressCount }}</dd>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.index', ['status' => 'On Progress']) }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                                    View in-progress reports<span aria-hidden="true"> &rarr;</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Resolved Card -->
                    <div class="overflow-hidden bg-white rounded-lg shadow">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 p-3 bg-green-100 rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 ml-4">
                                    <dt class="text-sm font-medium text-gray-500 truncate">Resolved Reports</dt>
                                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $resolvedCount }}</dd>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.index', ['status' => 'Resolved']) }}" class="text-sm font-medium text-green-600 hover:text-green-500">
                                    View resolved reports<span aria-hidden="true"> &rarr;</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Quick Actions</h3>
                </div>
                <div class="px-4 py-5 border-t border-gray-200 sm:p-6">
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('admin.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            View All Reports
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

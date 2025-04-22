<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Report Details') }}
        </h2>
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

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $report->title }}</h3>
                        <p class="mt-1 text-sm text-gray-600">Status: <span class="inline-block px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full">{{ $report->status }}</span></p>
                        <p class="mt-1 text-sm text-gray-600">Created: {{ $report->created_at->format('Y-m-d H:i:s') }}</p>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-700 text-md">Description</h4>
                        <p class="mt-2 text-gray-600">{{ $report->description }}</p>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-700 text-md">Photo Evidence</h4>
                        @if ($report->photo_path)
                            <img src="{{ asset('storage/' . $report->photo_path) }}" alt="Evidence" class="object-cover w-auto h-64 mt-2">
                        @else
                            <p class="mt-2 text-gray-600">No photo uploaded.</p>
                        @endif
                    </div>

                    <div class="flex space-x-4">
                        <a href="{{ route('reports.edit', $report->id) }}" class="inline-flex items-center px-4 py-2 font-semibold text-white bg-yellow-600 border border-transparent rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            Edit Report
                        </a>

                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 font-semibold text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Are you sure you want to delete this report?')">
                                Delete Report
                            </button>
                        </form>

                        <a href="{{ route('reports.index') }}" class="inline-flex items-center px-4 py-2 font-semibold text-white bg-gray-600 border border-transparent rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Back to Reports
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

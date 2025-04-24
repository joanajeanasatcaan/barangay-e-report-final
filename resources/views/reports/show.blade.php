<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Report Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 sm:p-6">
                    @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-6">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $report->title }}</h3>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $report->status === 'Resolved' ? 'bg-green-100 text-green-800' : ($report->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                                {{ $report->status === 'Pending' ? 'Pending Review' : $report->status }}
                            </span>
                        </div>
                        <p class="mb-1 text-sm text-gray-500">{{ $report->created_at->format('F jS, Y') }}</p>
                        <div class="flex items-center mb-1 text-sm text-gray-600">
                            @if ($report->category === 'Vandalism')
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 7 7 0 0118 0z"></path>
                                </svg>
                            @elseif ($report->category === 'Illegal Gambling')
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            @elseif ($report->category === 'Littering/Garbage Issue')
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            @elseif ($report->category === 'Neighborhood Dispute')
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2v-6a2 2 0 012-2h2m-2-4h4"></path>
                                </svg>
                            @endif
                            {{ $report->category }}
                        </div>
                        <p class="mb-1 text-sm text-gray-600"><strong>Location:</strong> {{ $report->location }}</p>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-700 text-md">Description</h4>
                        <p class="mt-2 text-gray-600">{{ $report->description }}</p>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-700 text-md">Photo Evidence</h4>
                        @if ($report->photo_path)
    <img src="{{ Storage::url($report->photo_path) }}" alt="Evidence" class="object-cover w-auto h-64 mt-2 rounded-md">
@else
    <p class="mt-2 text-gray-600">No photo uploaded.</p>
@endif

                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('reports.index') }}" class="inline-flex items-center px-4 py-2 mr-2 font-semibold text-gray-700 bg-gray-100 border border-transparent rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Back to Reports
                        </a>
                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 font-semibold text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Are you sure you want to delete this report?')">
                                Delete Report
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Your Report Page') }}
            </h2>
            <a href="{{ route('reports.create') }}"
                class="inline-flex items-center px-4 py-2 text-white bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class='mr-2 bx bx-plus'></i>Report Incident
            </a>
        </div>
        <div class="flex items-start justify-between">
            <p class="text-gray-500">
                {{ __('View and track all the incidents you\'ve reported') }}
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 sm:p-6">
                    @if ($reports->isEmpty())
                        <p class="text-sm text-gray-500">You haven't reported any incidents yet. Click 'Report Incident' to submit a new report.</p>
                    @else
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($reports as $report)
                                <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
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
                                    <p class="mb-3 text-sm text-gray-600">{{ $report->description }}</p>
                                    <div class="flex justify-end">
                                        <a href="{{ route('reports.show', $report->id) }}"
                                            class="inline-flex items-center px-3 py-1 font-semibold text-gray-700 bg-gray-100 border border-transparent rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Incident Report Details') }}
        </h2>
        <p class="text-gray-500">Details for {{ $report->title }}</p>
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
                        <h3 class="mb-2 text-lg font-medium">{{ $report->title }}</h3>
                        <p class="mb-1 text-sm text-gray-500">Reported on: {{ $report->created_at->format('F jS, Y') }}</p>
                        <p class="mb-1 text-sm text-gray-600"><strong>Category:</strong> {{ $report->category }}</p>
                        <p class="mb-1 text-sm text-gray-600"><strong>Location:</strong> {{ $report->location }}</p>
                        <p class="mb-1 text-sm text-gray-600"><strong>Description:</strong> {{ $report->description }}</p>
                        @if ($report->photo_path)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $report->photo_path) }}" alt="Evidence" class="object-cover w-auto h-48 rounded-md">
                            </div>
                        @endif
                        <p class="mt-2 text-sm text-gray-600"><strong>Reported by:</strong> {{ $report->user->name ?? 'Unknown User' }}</p>
                        <p class="text-sm text-gray-600"><strong>Status:</strong> {{ $report->status }}</p>
                    </div>

                    <div class="mb-6 ">
                        <form action="{{ route('admin.report.status', $report->id) }}" method="POST" class="inline ">
                            @csrf
                            <label for="status" class="block mb-1 text-sm font-medium text-gray-700">Update Status:</label>
                            <select name="status" id="status" class="w-1/5 p-2 border-gray-300 rounded-md shadow-sm form-control focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="Pending" {{ $report->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="On Progress" {{ $report->status === 'On Progress' ? 'selected' : '' }}>On Progress</option>
                                <option value="Resolved" {{ $report->status === 'Resolved' ? 'selected' : '' }}>Resolved</option>
                            </select>
                            <button type="submit" class="inline-flex items-center px-3 py-1 mt-2 font-semibold text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update Status
                            </button>
                        </form>
                    </div>

                    <div class="mb-6">
                        <a href="{{ route('admin.index') }}" class="inline-flex items-center px-4 py-2 font-semibold text-white bg-gray-600 border border-transparent rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Back to All Reports
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

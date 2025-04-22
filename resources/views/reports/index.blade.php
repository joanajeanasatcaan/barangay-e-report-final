<x-app-layout>
    <x-slot name="header">
        {{-- <div class=""> --}}
            <div class="flex items-center justify-between ">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Your Report Page') }}
                </h2>
                <a href="{{ route('reports.create') }}"
                    class="inline-flex items-center px-4 py-2 text-white bg-gray-900 border border-transparent rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class='mr-2 bx bx-plus'></i>Report Incident
                </a>
            </div>
            <div class="flex items-start justify-between">
                <p class="text-gray-500 ">
                    {{ __('View and track all the incidents youve reported') }}
                </p>
            </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-center ">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif



                    @if ($reports->isEmpty())
                    <p class="text-sm text-gray-500">You haven't reported any incidents yet. Click 'Report Incident' to
                        submit a new report..</p>
                    @else
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($reports as $report)
                        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $report->title }}</h3>
                            <p class="text-sm text-gray-600 truncate">{{ $report->description }}</p>
                            <div class="flex items-center justify-between mt-2">
                                <span
                                    class="inline-block px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full">{{
                                    $report->status }}</span>
                                <a href="{{ route('reports.show', $report->id) }}"
                                    class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd"
                                            d="M.458 10c1.762-3 4.948-4 8.994-4 4.046 0 7.232 1 8.994 4-1.762 3-4.948 4-8.994 4-4.046 0-7.232-1-8.994-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    View Details
                                </a>
                            </div>
                            <div class="flex mt-4 space-x-2">
                                <a href="{{ route('reports.edit', $report->id) }}"
                                    class="inline-flex items-center px-3 py-1 font-semibold text-white bg-yellow-600 border border-transparent rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                    Edit
                                </a>
                                <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1 font-semibold text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                        onclick="return confirm('Are you sure you want to delete this report?')">
                                        Delete
                                    </button>
                                </form>
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

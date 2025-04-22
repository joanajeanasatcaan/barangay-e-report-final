<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
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

                    <!-- <h3 class="mb-4 text-lg font-medium">Your Reports</h3> -->

                    @if ($reports->isEmpty())
                        <p>You haven’t submitted any reports yet.</p>
                        <a href="{{ route('reports.create') }}" class="inline-flex items-center px-4 py-2 mt-4 font-semibold text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Submit New Report
                        </a>
                    @else
                        @if ($reports->where('status', 'Pending')->count() > 0)

                        @endif

                        @if ($reports->where('status', 'On Progress')->count() > 0)

                        @endif

                        @if ($reports->where('status', 'Resolved')->count() > 0)

                        @endif

                        <a href="{{ route('reports.create') }}" class="max-width-100% inline-flex items-center px-4 py-2 mt-4 font-semibold text-white bg-gray-900 border border-transparent rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Submit New Report
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

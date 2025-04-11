<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h3 class="text-lg font-medium mb-4">Report Summary</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-indigo-100 p-4 rounded-lg shadow">
                            <h4 class="text-sm font-semibold text-gray-700">Pending Reports</h4>
                            <p class="text-2xl font-bold text-indigo-800">{{ $reports->where('status', 'Pending')->count() }}</p>
                        </div>
                        <div class="bg-blue-100 p-4 rounded-lg shadow">
                            <h4 class="text-sm font-semibold text-gray-700">On Progress Reports</h4>
                            <p class="text-2xl font-bold text-blue-800">{{ $reports->where('status', 'On Progress')->count() }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg shadow">
                            <h4 class="text-sm font-semibold text-gray-700">Resolved Reports</h4>
                            <p class="text-2xl font-bold text-green-800">{{ $reports->where('status', 'Resolved')->count() }}</p>
                        </div>
                    </div>

                    <!-- <h3 class="text-lg font-medium mb-4">Your Reports</h3> -->

                    @if ($reports->isEmpty())
                        <p>You haven’t submitted any reports yet.</p>
                        <a href="{{ route('reports.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-4">
                            Submit New Report
                        </a>
                    @else
                        <!-- Pending Reports -->
                        @if ($reports->where('status', 'Pending')->count() > 0)

                        @endif

                        <!-- On Progress Reports -->
                        @if ($reports->where('status', 'On Progress')->count() > 0)

                        @endif

                        <!-- Resolved Reports -->
                        @if ($reports->where('status', 'Resolved')->count() > 0)

                        @endif

                        <!-- <a href="{{ route('reports.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-4">
                            Submit New Report
                        </a> -->
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
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

                    <h3 class="text-lg font-medium mb-4">All Reports</h3>

                    @if ($reports->isEmpty())
                        <p>No reports have been submitted yet.</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        User
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Photo
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Created At
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($reports as $report)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $report->user->name ?? 'Unknown User' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $report->title }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $report->status }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($report->photo_path)
                                                <img src="{{ asset('storage/' . $report->photo_path) }}" alt="Evidence" class="h-16 w-16 object-cover">
                                            @else
                                                No photo
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $report->created_at->format('Y-m-d H:i:s') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('admin.report.status', $report->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-control border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <option value="Pending" {{ $report->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="On Progress" {{ $report->status === 'On Progress' ? 'selected' : '' }}>On Progress</option>
                                                    <option value="Resolved" {{ $report->status === 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                                </select>
                                                <button type="submit" class="mt-2 inline-flex items-center px-3 py-1 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Update Status
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

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
